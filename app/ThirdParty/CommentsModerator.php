<?php

namespace App\ThirdParty;

use Exception;
use Gemini;
use Gemini\Data\Content;
use Gemini\Data\SafetySetting;
use Gemini\Enums\HarmBlockThreshold;
use Gemini\Enums\HarmCategory;

class CommentsModerator
{
    private static string $filter;
    private static Gemini\Client $client;

    private static function init()
    {
        self::$client = Gemini::client(env('app.gemini.apiKey') ?? '');
        self::$filter = "Analyse the message, if it's in Shona, translate it. When that's done, check if it is safe for a public school platform, not abusive, does not have dirty words, and does not contain any hate speech, it must be children friendly. Return the response as a JSON with a safe boolean key, translation, error_message (if any) and context message. Your reply must be plain text.";
    }

    public static function check(string $comment, int $count = 1): object
    {
        self::init();
        if ($count > 3) throw new Exception("Failed to process request");
        $safetySettingDangerousContent = new SafetySetting(
            category: HarmCategory::HARM_CATEGORY_DANGEROUS_CONTENT,
            threshold: HarmBlockThreshold::BLOCK_NONE
        );

        $safetySettingHateSpeech = new SafetySetting(
            category: HarmCategory::HARM_CATEGORY_HATE_SPEECH,
            threshold: HarmBlockThreshold::BLOCK_NONE
        );
        $safetySettingHarrassment = new SafetySetting(
            category: HarmCategory::HARM_CATEGORY_HARASSMENT,
            threshold: HarmBlockThreshold::BLOCK_NONE
        );
        $chat = self::$client->geminiPro()
            ->withSafetySetting($safetySettingDangerousContent)
            ->withSafetySetting($safetySettingHarrassment)
            ->withSafetySetting($safetySettingHateSpeech)
            ->startChat(history: [
                Content::parse(part: self::$filter),
            ]);
        try {
            $result = $chat->sendMessage($comment)->text();
            $response = json_decode($result);
        } catch (\Exception $e) {
            if ($response) $response = json_decode(str_replace(['```json', '```'], '', $result));
        }

        // if result is empty, then it's probably because Gemini blocked the prompt
        if (!$result) return json_decode(json_encode(['error_message' => 'Our systems do not process such comments, please rethink and comment again.', 'safe' => false]));

        // sometimes a timeout causes it to return null, so try again
        if (!$response) return self::check($comment, $count + 1);

        return $response;
    }
}
