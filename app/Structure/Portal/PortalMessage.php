<?php


namespace App\Structure\Portal;


class PortalMessage
{
    public const KIP_NEW = 'kip_new';
    public const KIP_COMMENT = 'kip_comment';
    public const KIP_UPDATE = 'kip_update';
    public const PUSH = 'push';

    public static $types = [
        PortalMessage::KIP_NEW,
        PortalMessage::KIP_COMMENT,
        PortalMessage::KIP_UPDATE,
        PortalMessage::PUSH
    ];

    public function getTypes() : array
    {
        return self::$types;
    }

    public function inTypes(string $type) : bool
    {
        return in_array($type, self::$types);
    }
}
