<?php

namespace WellnessLiving\Wl\Pay\Bank\Card\Add;

use WellnessLiving\WlModelAbstract;
use WellnessLiving\Wl\Business\BusinessPaymentCaptcha;
use WellnessLiving\Wl\Pay\Owner\OwnerModel;

/**
 * Adds a payment card to a user’s account.
 * The GET method retrieves an HTML code that contains the fields necessary to provide the information needed to
 * add the payment card.
 * The POST method will actually add the payment card.
 *
 * This endpoint using captcha check.
 * To pass captcha need study the documentation by captcha API, there you will find that you need to send a captcha for a specific action.
 * For this API an action is {@link BusinessPaymentCaptcha::CID}.
 */
class AddModel extends WlModelAbstract
{
  /**
   * An array containing payment card information with the following fields:
   *
   * <dl>
   *   <dt>
   *     array <var>a_pay_address</var>
   *   </dt>
   *   <dd>
   *     Address information:
   *     <dl>
   *       <dt>bool <var>is_new</var></dt>
   *       <dd>`true` - add new address. `false` - use existing address.</dd>
   *       <dt>string <var>k_pay_address</var></dt>
   *       <dd>The chosen payment address ID. THis will be set even if the user decided to add a new address.</dd>
   *       <dt>string <var>k_geo_country</var></dt>
   *       <dd>The country key.</dd>
   *       <dt>string <var>k_geo_region</var></dt>
   *       <dd>The region key.</dd>
   *       <dt>string <var>s_city</var></dt>
   *       <dd>The city name.</dd>
   *       <dt>string <var>s_name</var></dt>
   *       <dd>The user name.</dd>
   *       <dt>string <var>s_street1</var></dt>
   *       <dd>The first address line.</dd>
   *       <dt>string <var>s_street2</var></dt>
   *       <dd>The second address line.</dd>
   *       <dt>string <var>s_phone</var></dt>
   *       <dd>The phone number.</dd>
   *       <dt>string <var>s_postal</var></dt>
   *       <dd>The postal code.</dd>
   *     </dl>
   *   </dd>
   *   <dt>
   *     int <var>i_csc</var>
   *   </dt>
   *   <dd>
   *     The payment card security code, also known as the CVC or CVV.
   *   </dd>
   *   <dt>
   *     int <var>i_month</var>
   *   </dt>
   *   <dd>
   *     The number of the month when the payment card expires. 1=January and 12=December.
   *   </dd>
   *   <dt>
   *     int <var>i_year</var>
   *   </dt>
   *   <dd>
   *     The last two digits of the year when the payment card expires.
   *   </dd>
   *   <dt>
   *     int <var>id_pay_actor</var>
   *   </dt>
   *   <dd>
   *     Pay actor id.
   *   </dd>
   *   <dt>
   *     string <var>k_pay_bank</var>
   *   </dt>
   *   <dd>
   *     Key of existing payment source in case of editing.
   *     Empty if new pay source is being added.
   *   </dd>
   *   <dt>
   *     string <var>s_name</var>
   *   </dt>
   *   <dd>
   *     The name as it appears on the payment card.
   *   </dd>
   *   <dt>
   *     string <var>s_number</var>
   *   </dt>
   *   <dd>
   *     The payment card number with no spaces or dashes.
   *   </dd>
   * </dl>
   *
   * @post post
   * @var array
   */
  public $a_card_detail = [];

  /**
   * The HTML form containing the fields required to add a card.
   *
   * @get result
   * @var string
   */
  public $html_widget;

  /**
   * The business key number used internally by WellnessLiving.
   *
   * @delete get
   * @get get
   * @post get
   * @var string
   */
  public $k_business = '0';

  /**
   * The location key.
   *
   * @get get
   * @post get
   * @var string
   */
  public $k_location = '0';

  /**
   * Pay bank key to delete.
   *
   * @delete get
   * @var string
   */
  public $k_pay_bank = '0';

  /**
   * The payment owner ID. This is different from the user ID. It can be found with
   * the {@link OwnerModel}.
   *
   * @get get
   * @post get
   * @var string
   */
  public $k_pay_owner = '0';
}

?>