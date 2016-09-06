<?php
require_once('vendor/autoload.php');
class StripPayment
{
    public $stripeKey = "sk_test_CAs7N9ZSZzhIRpVOfZL3Sq8Q";

    function StripPayment()
    {
        \Stripe\Stripe::setApiKey($this->stripeKey);
    }


    /*
     * CUSTOMER SECTION
     */

    /*
     * @param email
     *
     * @return success 1 or 0
     * @return data array or message
     * */

    public function CreateCustomer($email)
    {
        try {
            $customer = \Stripe\Customer::create(array(
                "description" => "Customer for $email",
                "email" => $email
            ));
            return $this->getResponse(1, $customer->getLastResponse()->json);
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }
    }

//get customer
    public function getCustomer($cid)
    {
        try {
            $customer = \Stripe\Customer::retrieve($cid);
            return $this->getResponse(1, $customer);
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }

    }

//update customer
    public function UpdateCustomer($cid, $desc)
    {

        $customer = $this->getCustomer($cid);
        if ($customer["success"] == 1) {
            try {
                $customer = $customer["data"];
                $customer->description = $desc;
                $customer->save();
                return $this->getResponse(1, $customer);
            } catch (Exception $e) {

                return $this->getResponse(0, $e->getMessage());
            }
        } else {
            return $this->getResponse(0, $customer["data"]);
        }

    }

    //Delete customer
    public function DeleteCustomer($cid)
    {

        $customer = $this->getCustomer($cid);
        if ($customer["success"] == 1) {
            try {
                $customer = $customer["data"];
                $customer->delete();
                return $this->getResponse(1, $customer);
            } catch (Exception $e) {
                return $this->getResponse(0, $e->getMessage());
            }
        } else {
            return $this->getResponse(0, $customer["data"]);
        }

    }

    //get all customer
    public function getAllCustomers()
    {
        try {
            //if u wanna set limit you can use like this \Stripe\Customer::all(array("limit" => 3))
            //array("limit" => 3);
            $customer = \Stripe\Customer::all();
            return $this->getResponse(1, $customer->getLastResponse()->json);
        } catch (Exception $e) {
            return $this->getResponse(0, $e->getMessage());
        }

    }
    //get all customer


    /*
     * RESPONSE MANAGEMENT
     */
    private function getResponse($success, $data)
    {
        $res = array();
        $res['success'] = $success;
        $res['data'] = $data;
        return $res;
    }
    /*
     * card sectin https://stripe.com/docs/api#cards
     */
    //create card

    public function CreateCardofCustomer($cid, $data)
    {

        $customer = $this->getCustomer($cid);
        if ($customer["success"] == 1) {
            try {
                $customer = $customer["data"];
                $customer->sources->create(array(
                    "source" => array(
                        "object" => "card",
                        "exp_month" => $data["exp_month"],
                        "exp_year" => $data["exp_year"],
                        "number" => $data["number"],
                        "currency" => "usd",
                        "cvc" => $data["cvc"]
                    )
                ));
                //$customer->save();
                return $this->getResponse(1, $customer);
            } catch (Exception $e) {

                return $this->getResponse(0, $e->getMessage());
            }
        } else {
            return $this->getResponse(0, $customer["data"]);
        }

    }


    //get card detial
    public function getCardDetail($cid, $cardid)
    {

        $customer = $this->getCustomer($cid);
        if ($customer["success"] == 1) {
            try {
                $customer = $customer["data"];
                $card = $customer->sources->retrieve($cardid);
                return $this->getResponse(1, $card);
            } catch (Exception $e) {

                return $this->getResponse(0, $e->getMessage());
            }
        } else {
            return $this->getResponse(0, $customer["data"]);
        }

    }


    //update card detial
    public function UpdateCardDetail($cid, $cardid,$name)
    {

        $customer = $this->getCustomer($cid);
        if ($customer["success"] == 1) {
            try {
                $customer = $customer["data"];
                $card = $customer->sources->retrieve($cardid);
                $card->name =$name;
                $card->save();
                return $this->getResponse(1, $card);
            } catch (Exception $e) {

                return $this->getResponse(0, $e->getMessage());
            }
        } else {
            return $this->getResponse(0, $customer["data"]);
        }

    }


    //Delete card
    public function DeleteCard($cid, $cardid)
    {

        $customer = $this->getCustomer($cid);
        if ($customer["success"] == 1) {
            try {
                $customer = $customer["data"];
                $card = $customer->sources->retrieve($cardid)->delete();
                return $this->getResponse(1, $card);
            } catch (Exception $e) {

                return $this->getResponse(0, $e->getMessage());
            }
        } else {
            return $this->getResponse(0, $customer["data"]);
        }

    }


    //List of all  card
    public function getAllCards($cid)
    {
          try {
                $card = \Stripe\Customer::retrieve($cid)->sources->all(array('object' => 'card'));
                return $this->getResponse(1, $card);
            } catch (Exception $e) {

                return $this->getResponse(0, $e->getMessage());
            }
    }

    /*
     * payment section start
     */

    public function CreatePayment($items)
    {


        try {
            $new_charge = \Stripe\Charge::create(array(
                "amount" => $items["amount"],
                "currency" =>'usd',
                "customer" => $items["customer"],
                "card" =>$items["card"]
            ));
            return $this->getResponse(1, $new_charge);
        } catch (Exception $e) {

            return $this->getResponse(0, $e->getMessage());
        }
    }
}


?>