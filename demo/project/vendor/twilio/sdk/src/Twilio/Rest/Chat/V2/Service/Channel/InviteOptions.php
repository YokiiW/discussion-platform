<?php
/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Chat
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Chat\V2\Service\Channel;

use Twilio\Options;
use Twilio\Values;

abstract class InviteOptions
{
    /**
     * @param string $roleSid The SID of the [Role](https://www.twilio.com/docs/chat/rest/role-resource) assigned to the new member.
     * @return CreateInviteOptions Options builder
     */
    public static function create(
        
        string $roleSid = Values::NONE

    ): CreateInviteOptions
    {
        return new CreateInviteOptions(
            $roleSid
        );
    }



    /**
     * @param string[] $identity The [User](https://www.twilio.com/docs/chat/rest/user-resource)'s `identity` value of the resources to read. See [access tokens](https://www.twilio.com/docs/chat/create-tokens) for more details.
     * @return ReadInviteOptions Options builder
     */
    public static function read(
        
        array $identity = Values::ARRAY_NONE

    ): ReadInviteOptions
    {
        return new ReadInviteOptions(
            $identity
        );
    }

}

class CreateInviteOptions extends Options
    {
    /**
     * @param string $roleSid The SID of the [Role](https://www.twilio.com/docs/chat/rest/role-resource) assigned to the new member.
     */
    public function __construct(
        
        string $roleSid = Values::NONE

    ) {
        $this->options['roleSid'] = $roleSid;
    }

    /**
     * The SID of the [Role](https://www.twilio.com/docs/chat/rest/role-resource) assigned to the new member.
     *
     * @param string $roleSid The SID of the [Role](https://www.twilio.com/docs/chat/rest/role-resource) assigned to the new member.
     * @return $this Fluent Builder
     */
    public function setRoleSid(string $roleSid): self
    {
        $this->options['roleSid'] = $roleSid;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Chat.V2.CreateInviteOptions ' . $options . ']';
    }
}



class ReadInviteOptions extends Options
    {
    /**
     * @param string[] $identity The [User](https://www.twilio.com/docs/chat/rest/user-resource)'s `identity` value of the resources to read. See [access tokens](https://www.twilio.com/docs/chat/create-tokens) for more details.
     */
    public function __construct(
        
        array $identity = Values::ARRAY_NONE

    ) {
        $this->options['identity'] = $identity;
    }

    /**
     * The [User](https://www.twilio.com/docs/chat/rest/user-resource)'s `identity` value of the resources to read. See [access tokens](https://www.twilio.com/docs/chat/create-tokens) for more details.
     *
     * @param string[] $identity The [User](https://www.twilio.com/docs/chat/rest/user-resource)'s `identity` value of the resources to read. See [access tokens](https://www.twilio.com/docs/chat/create-tokens) for more details.
     * @return $this Fluent Builder
     */
    public function setIdentity(array $identity): self
    {
        $this->options['identity'] = $identity;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Chat.V2.ReadInviteOptions ' . $options . ']';
    }
}
