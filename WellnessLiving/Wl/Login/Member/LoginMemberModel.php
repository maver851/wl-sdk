<?php

namespace WellnessLiving\Wl\Login\Member;

use WellnessLiving\WlModelAbstract;

/**
 * Updates client ID.
 */
class LoginMemberModel extends WlModelAbstract
{
    /**
     * The date when client became a member.
     *
     * @post result
     * @var string
     */
    public $dt_member = '';

    /**
     * The business key.
     *
     * @get get
     * @post get
     * @var string
     */
    public $k_business = '';

    /**
     * The user's ID to get/set.
     *
     * @get result
     * @post get
     * @var string
     */
    public $s_member = '';

    /**
     * The user's key.
     *
     * @get get
     * @post get
     * @var string
     */
    public $uid = '';
}

?>