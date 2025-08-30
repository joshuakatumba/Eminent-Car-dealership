<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityService
{
    public static function log($action, $description, $model = null, $properties = [])
    {
        $user = Auth::user();
        
        if (!$user) {
            return null;
        }

        return Activity::create([
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
            'model_type' => $model ? get_class($model) : null,
            'model_id' => $model ? $model->id : null,
            'properties' => $properties,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    public static function logLogin($user)
    {
        return self::log('login', "User {$user->name} logged in");
    }

    public static function logLogout($user)
    {
        return self::log('logout', "User {$user->name} logged out");
    }

    public static function logCreate($model, $description = null)
    {
        $modelName = class_basename($model);
        $description = $description ?: "Created new {$modelName}";
        
        return self::log('create', $description, $model);
    }

    public static function logUpdate($model, $description = null)
    {
        $modelName = class_basename($model);
        $description = $description ?: "Updated {$modelName}";
        
        return self::log('update', $description, $model);
    }

    public static function logDelete($model, $description = null)
    {
        $modelName = class_basename($model);
        $description = $description ?: "Deleted {$modelName}";
        
        return self::log('delete', $description, $model);
    }

    public static function logSettingsUpdate($description)
    {
        return self::log('settings_update', $description);
    }

    public static function logContactMessageReplied($contactMessage)
    {
        return self::log('contact_replied', "Replied to contact message from {$contactMessage->name}", $contactMessage);
    }
}
