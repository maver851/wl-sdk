<?php

namespace WellnessLiving\Wl\Book\Process;

use WellnessLiving\Core\a\ADateWeekSid;
use WellnessLiving\Core\a\ADurationSid;
use WellnessLiving\WlModelAbstract;
use WellnessLiving\Wl\Classes\RequirePaySid;
use WellnessLiving\Wl\Family\Relation\WlFamilyRelationSid;
use WellnessLiving\Wl\Mode\ModeSid;

/**
 * Performs the booking wizard steps.
 *
 * This endpoint includes changes to the list of steps if the service is already booked for the currently selected client,
 * and if {@link ProcessModel::$is_family_relation_book} is set to `true`.
 */
class Process59Model extends WlModelAbstract
{
  /**
   * Relationships who clients are allowed to book for.
   * One of the {@link WlFamilyRelationSid} constants.
   *
   * This will be `null` if clients aren't allowed to book for their relationships.
   *
   * @depreated Use {@link ProcessModel::$is_family_relation_book} instead. Full list of relatives available, see {@link WlFamilyRelationSid}.
   * @get result
   * @var int[]|null
   */
  public $a_family_relation_login_allow;

  /**
   * All the steps to be performed to make a booking. Every element has the next keys:
   * <dl>
   *   <dt>
   *     int <var>id_book_process</var>
   *   </dt>
   *   <dd>
   *     The step ID. One of the {@link ProcessSpaSid} constants.
   *   </dd>
   *   <dt>
   *     bool [<var>is_current</var>]
   *   </dt>
   *   <dd>
   *     <tt>true</tt> - this item is current.
   *     <tt>false</tt> - this item isn't current or not set yet.
   *   </dd>
   * </dl>
   *
   * @get result
   * @var array[]
   */
  public $a_path = [];

  /**
   * Information about the recurring booking:
   * <dl>
   *   <dt>int[] <var>a_day</var></dt>
   *   <dd>
   *     The days of week when the appointment repeat.One of the {@link ADateWeekSid} constants.
   *     Should be passed for any type of repetition.
   *   </dd>
   *   <dt>int[] <var>a_week</var></dt>
   *   <dd>Deprecated, use `a_day` instead!</dd>
   *   <dt>string [<var>dl_end</var>]</dt>
   *   <dd>Deprecated, use `dt_from` and `dt_to` instead!</dd>
   *   <dt>
   *     string [<var>dt_from</var>]
   *   </dt>
   *   <dd>
   *     Date to start recurring booking.
   *     Expected for `id_repeat_
   *   </dd>
   *   <dt>
   *     string [<var>dt_to</var>]
   *   </dt>
   *   <dd>
   *     Date to complete recurring booking.
   *     Expected for `id_repeat_
   *   </dd>
   *   <dt>
   *      int [<var>i_count</var>]
   *    </dt>
   *    <dd>
   *      The number of occurrences after which the appointment's repeat cycle stops.
   *      Should be empty if the repeat cycle doesn't stop after a certain number of occurrences.
   *      Expected for `id_repeat_
   *    </dd>
   *   <dt>int <var>i_duration</var></dt>
   *   <dd>Count of days\weeks\months between recurring bookings.</dd>
   *   <dt>int [<var>i_occurrence</var>]</dt>
   *   <dd>Deprecated, use `i_count` instead!</dd>
   *   <dt>int <var>i_period</var></dt>
   *   <dd>Deprecated, use `i_duration` instead!</dd>
   *   <dt>
   *     int <var>id_duration</var>
   *   </dt>
   *   <dd>
   *     The measurement unit of `i_period`. One of the {@link ADurationSid} constants.
   *     Available duration units are: {@link ADurationSid::DAY}, {@link ADurationSid::WEEK}, {@link ADurationSid::MONTH}.
   *   </dd>
   *   <dt>int <var>id_period</var></dt>
   *   <dd>Deprecated, use `id_duration` instead!</dd>
   *   <dt>int <var>id_repeat_end</var></dt>
   *   <dd>Possible ways to stop repeatable events.</dd>
   * </dl>
   *
   * This will be `null` if the booking isn't recurring.
   *
   * @post post
   * @var array|null
   */
  public $a_repeat = null;

  /**
   * Determines whether the class/event can be booked at this step or not.
   * This is an external process control flag.
   *
   * @post post
   * @var bool
   */
  public $can_book = true;

  /**
   * Date/time to which session is booked.
   *
   * @get get
   * @post get
   * @var string
   */
  public $dt_date_gmt = '';

  /**
   * The mode type. One of the {@link ModeSid} constants.
   *
   * @get get
   * @post get
   * @var int
   */
  public $id_mode = 0;

  /**
   * The purchase rule ID.
   * One of the {@link RequirePaySid} constants.
   *
   * @get result
   * @var int
   */
  public $id_pay_require;

  /**
   * `true` if this class has age restriction and requires user to specify age. `false` otherwise.
   *
   * @get result
   * @var bool
   */
  public $is_age_require;

  /**
   * Determines if the client must authorize the credit card.
   *
   * @get result
   * @var bool
   */
  public $is_card_authorize = false;

  /**
   * Checking whether the client has a credit card (if configured in the business) will be skipped if this flag is set to `false`.
   *
   * Use this field with caution.
   * The final booking will not use this flag and the check will still be performed.
   *
   * @get get
   * @post get
   * @var bool
   */
  public $is_credit_card_check = true;

  /**
   * If `true`, the session being booked is an event. Otherwise, this will be `false`.
   *
   * @get result
   * @var bool
   */
  public $is_event;

  /**
   * Determines whether clients are allowed to book for their relationships without switching profiles.
   *
   * @get result
   * @var bool
   */
  public $is_family_relation_book;

  /**
   * `true` if user pressed 'Pay later'.
   * `false` if user pressed 'Pay now'.
   *
   * @post post
   * @var bool
   */
  public $is_force_pay_later = false;

  /**
   * Determines whether the class/event is free (price).
   *
   * @get result
   * @var bool
   */
  public $is_free = false;

  /**
   * `true` if the client has an ach account, `false` otherwise.
   *
   * @get result
   * @var bool
   */
  public $is_have_ach = false;

  /**
   * If `true`, the client has a credit card. Otherwise, this will be `false`.
   *
   * @get result
   * @var bool
   */
  public $is_have_credit_card = false;

  /**
   * `true` - the client can select several sessions per booking.
   *
   * `false` - the client can't select several sessions.
   *
   * @get result
   * @var bool
   */
  public $is_session;

  /**
   * If `true`, the user can be placed on a wait list. Otherwise, this will be `false`.
   *
   * @get result
   * @var bool
   */
  public $is_wait;

  /**
   * If `true`, the user can be placed on a wait list without payment, `false` otherwise.
   *
   * @get result
   * @var bool
   */
  public $is_wait_list_unpaid;

  /**
   * Key of session which is booked.
   *
   * @get get
   * @post get
   * @var string
   */
  public $k_class_period = '0';

  /**
   * The key of the location where the session is booked.
   *
   * @get result
   * @var string
   */
  public $k_location;

  /**
   * Login promotion to be used to book a class.
   *
   * @post post
   * @var string
   */
  public $k_login_promotion = '';

  /**
   * Session pass to be used to book a class.
   *
   * @post post
   * @var string
   */
  public $k_session_pass = '';

  /**
   * Key of a user who is making a book.
   *
   * @get get
   * @post get
   * @var string
   */
  public $uid = '0';
}

?>