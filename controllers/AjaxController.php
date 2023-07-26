<?php

/**
 * Created by PhpStorm.
 * User: Multiline
 * Date: 7/9/2018
 * Time: 7:22 AM
 */

namespace app\controllers;

use app\models\LabFormField;
use app\helpers\datetime;
use app\helpers\Helper;
use app\helpers\push_notification;
use app\models\AdditionalCostItem;
use app\models\DiscountKey;
use app\models\ExtraSaleItem;
use app\models\ExtraSaleOptionItem;
use app\models\ItemCategory;
use app\models\ItemName;
use app\models\OptionalItem;
use app\models\Patient;
use app\models\Payments;
use app\models\ReferredDoctor;
use app\models\Sales;
use app\models\SalesItem;
use app\models\User;
use app\models\LabFormSubmit;
use app\models\LabFormFieldSubmit;
use app\models\Mop;
use app\models\UserReport;
use yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\db\ActiveQuery;

class AjaxController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionGetDiscountKey() {
        if (Yii::$app->user->identity->role != "Admin") {
            $model = DiscountKey::find()->where(['status' => '1'])->all();
        } else {
            $model = DiscountKey::find()->all();
        }
        $category_array = array();
        $dis['id'] = 0;
        $dis['name'] = "Select Reason";
        $category_array[] = $dis;
        foreach ($model as $key => $value) {
            $dis['id'] = $value['id'];
            $dis['name'] = $value['key_name'];
            $category_array[] = $dis;
        }
        $response['keys'] = $category_array;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        \Yii::$app->response->data = $category_array;
    }

    public function actionGetItemCategory() {
        if (Yii::$app->user->identity->role != "Admin") {
            $model = ItemCategory::find()->where(['status' => '1'])->all();
        } else {
            $model = ItemCategory::find()->all();
        }
        $category_array = array();
        foreach ($model as $key => $value) {
            $category['id'] = $value['id'];
            $category['name'] = $value['name'];
            $category_array[] = $category;
        }
        $response['category'] = $category_array;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        \Yii::$app->response->data = $response;
    }

    public function actionGetItems() {
        if (isset($_GET['sale_id'])) {
            $id = $_GET['sale_id'];
            $model = SalesItem::find()->where(['sale_id' => $id])->all();
            $items_array = array();

            foreach ($model as $value) {
                $item['id'] = $value->item->id;
                $item['name'] = $value->item->name;
                $item['cat_id'] = $value->item->cat_id;
                $item['rate'] = $value->item->price;
                $item['discount'] = $value->item_discount;
                $item['dS'] = $value->discount_reason;
                if ($value->item->consultant_percentage) {
                    //$consultant_amount = ($value['price'] * $value['consultant_percentage'])/100;
                    $consultant_amount = $value->item->consultant_percentage;
                } else {
                    $consultant_amount = 0;
                }
                $item['consultant_amount'] = $consultant_amount;
                $items_array[] = $item;
            }
            //print_r($items_array);
            //return 1;
        } else {
            $model = ItemName::find()->where(['status' => '1'])->all();

            $items_array = array();
            foreach ($model as $key => $value) {
                $item['id'] = $value['id'];
                $item['name'] = $value['name'];
                $item['cat_id'] = $value['cat_id'];
                $item['rate'] = $value['price'];

                $item['discount'] = 0;
                $item['dS'] = 0;
                if ($value['consultant_percentage']) {
                    //$consultant_amount = ($value['price'] * $value['consultant_percentage'])/100;
                    $consultant_amount = $value['consultant_percentage'];
                } else {
                    $consultant_amount = 0;
                }
                $item['consultant_amount'] = $consultant_amount;
                $items_array[] = $item;
            }
        }

        $response['item'] = $items_array;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        \Yii::$app->response->data = $response;
    }

    public function actionSearchPatient() {
        $query = $_GET['query'];
        $id = $_GET['sale_id'];
        if (isset($query)) {
            $model = Patient::find()->where([
                        'and',
                        [
                            'or',
                            ['like', 'name', $query],
                            ['like', 'reg_no', $query],
                            ['like', 'cnic', $query],
                            ['like', 'phone_no', $query]
                        ],
                        ['=', 'status', '1']
                    ])->limit(11)->all();
            $patient_array = array();
            foreach ($model as $key => $value) {
                $patient['id'] = $value['id'];
                $patient['name'] = $value['name'];
                $patient['reg_no'] = $value['reg_no'];
                $patient['phone_no'] = $value['phone_no'];
                $patient['age'] = $value['age'] . 'Y';
                $patient_array[] = $patient;
            }
            $response['patient'] = $patient_array;
            echo json_encode($patient_array);
        } elseif (isset($id)) {
            $model = Sales::findOne($id);

            //print_r($model);
            $patient_array = array();
            $patient['id'] = $model->patient->id;
            $patient['name'] = $model->patient->name;
            $patient['reg_no'] = $model->patient->reg_no;
            $patient['phone_no'] = $model->patient->phone_no;
            $patient['age'] = $model->patient->age . 'Y';
            $patient['doctor_id'] = $model->referred_doctor_id;
            $patient['doctor_name'] = $model->referred->name;
            $patient_array[] = $patient;

            $response['patient'] = $patient_array;
            echo json_encode($patient_array);
        }
        exit;
        // //echo json_encode("Result:".$_GET['query']);
        // $model = Patient::find()
        // //->andWhere(['status'=>'1'])
        // //->andWhere(['like','status',$query])
        // ->orWhere(['like','name',$query])
        // ->orWhere(['like','reg_no',$query])
        // ->orWhere(['like','cnic',$query])
        // ->orWhere(['like','phone_no',$query])
        // ->where(['status' => '0'])
        // //->orWhere(['like','status','1'])
        // ->all();
    }

    public function actionSearchReferred() {
        $query = $_GET['query'];
        $model = ReferredDoctor::find()->orWhere(['like', 'name', $query])->andWhere(['status' => '1'])->limit(11)->all();
        $referred_array = array();
        foreach ($model as $key => $value) {
            $ref['id'] = $value['id'];
            $ref['name'] = $value['name'];
            $ref['cnic'] = $value['cnic'];
            $ref['phone_no'] = $value['phone_no'];
            $ref['email'] = $value['email'];
            $ref['address'] = $value['address'];
            $referred_array[] = $ref;
        }
        echo json_encode($referred_array);
    }

    public function actionTest() {
        $patientLastReg = Patient::find()->select('reg_no')->orderBy(['id' => SORT_DESC])->one();
        $str = $patientLastReg->reg_no;
        preg_match_all('!\d+!', $str, $matches);
        $reg_no = 'ADC-' . ($matches[0][0] + 1);
        echo $reg_no;
    }

    public function actionSavePatient() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $patient = new Patient();
        $patient->name = $request->fullname;
        $patient->cnic = "" . $request->cnic;
        $patient->phone_no = "" . $request->phonenumber;
        $patient->gender = $request->gender;
        $patient->age = $request->age;
        $patient->age_type = $request->ageType;
        $patient->relationship = $request->relationship;
        $patient->city = $request->city;
        $patient->country = $request->country;
        $patient->address = $request->address;
        $patient->email = $request->email;
        $patient->whatsapp_no = "" . $request->whatsapp;
        $patient->status = "1";
        $patient->created_by = Yii::$app->user->id;
        $patient->created_on = date("Y-m-d H:i:s");

        //Generate Unique Patinet ID

        $patientLastReg = Patient::find()->select('reg_no')->orderBy(['id' => SORT_DESC])->one();
        $str = $patientLastReg->reg_no;
        preg_match_all('!\d+!', $str, $matches);
        $reg_no = 'ADC-' . ($matches[0][0] + 1);
        $patient->reg_no = $reg_no;
        if ($patient->save()) {
            $response['id'] = $patient->id;
            $response['fullname'] = $patient->name;
            $response['reg_no'] = $patient->reg_no;
            $response['phone_no'] = $patient->phone_no;
            $response['age'] = $patient->age . $patient->age_type;
            $response['status'] = "True";
            echo json_encode($response);
        } else {
            /* echo "<pre>";
              print_r($patient);
              echo "</pre>"; */
            // return true;
            $response['status'] = "False";
            echo json_encode($response);
        }
    }

    public function actionSaveReferred() {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $referred = new ReferredDoctor();
        $referred->name = $request->fullname;
        $referred->cnic = "" . $request->cnic;
        $referred->phone_no = "" . $request->phonenumber;
        $referred->address = $request->address;
        $referred->email = $request->email;
        $referred->hospital_name = $request->hospital;
        $referred->status = "1";
        $referred->created_by = Yii::$app->user->id;
        $referred->created_on = date("Y-m-d H:i:s");
        if ($referred->save()) {
            $response['id'] = $referred->id;
            $response['fullname'] = $referred->name;
            $response['status'] = "True";
            echo json_encode($response);
        } else {
            /* echo "<pre>";
              print_r($patient);
              echo "</pre>"; */
            $response['status'] = "False";
            echo json_encode($response);
        }
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionGetBill() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $invoice = $_GET['id'];
        $sales = \app\models\Sales::find()
                        ->joinWith('saleitems')
                        ->joinWith('payments')
                        ->joinWith('patient')
                        ->joinWith('referred')
                        ->joinWith('payments.mop')
                        ->andWhere(['sale.invoice_no' => $invoice])->one();
        $response['id'] = $sales->id;
        $response['patient_id'] = $sales->patient_id;
        $response['referred_doctor_id'] = $sales->referred_doctor_id;
        $response['total'] = $sales->total;
        $response['discount'] = $sales->discount;
        $response['discount_type'] = $sales->discount_type;
        $response['grand_total'] = $sales->grand_total;
        $response['paid_amount'] = $sales->paid_amount;
        return $response;
    }

    public function actionSubmitOrder() {
        $sale_id = $_GET['sale_id'];
        if (!isset($sale_id)) {
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
            $sale = new Sales();
            $sale->hospital_id = 1;
            $sale->patient_id = $request->patient_id;
            $sale->referred_doctor_id = $request->referral_doctor_id;
            $sale->total = $request->total;
            if ($request->test_discount > 0) {
                $sale->discount = $request->test_discount;
                $sale->discount_type = $request->test_discount . 'Rs';
            } else {
                $sale->discount = $request->discount;
                $sale->discount_type = $request->discount_type;
            }
            $sale->tax = $request->tax;
            $sale->grand_total = $request->grand_total;
            $sale->total_items = $request->total_items;

            // $request->discount;
            // $request->discount_type;

            if ($request->mop[0]->value >= $request->grand_total) {
                $sale->paid_amount = $request->grand_total;
                $sale->payment_status = "1"; //Paid
            } else if ($request->mop[0]->value == 0) {
                $sale->paid_amount = $request->mop[0]->value;
                $sale->payment_status = "0"; //Due Amount
            } else {
                $sale->paid_amount = $request->mop[0]->value;
                $sale->payment_status = "2"; //Patrial
            }

            //$sale->change_amount = $request->grand_total - $request->mop[0]->value;
            //Generate Unique Invoice ID

            $saleLastInvoice = Sales::find()->select('invoice_no')->orderBy(['id' => SORT_DESC])->one();
            $str = $saleLastInvoice->invoice_no;
            preg_match_all('!\d+!', $str, $matches);
            if ($matches[0][0] == 0) {
                $matches = 100;
            } else {
                $matches = $matches[0][0];
            }
            $invoice_no = 'ADC' . ($matches + 1);
            $sale->invoice_no = $invoice_no;
            $sale->sale_status = "1";
            $sale->status = "1";
            $sale->created_by = Yii::$app->user->id;
            $sale->created_on = date("Y-m-d H:i:s");
            if ($sale->save()) {
                foreach ($request->order_list as $data) {
                    $saleItem = new SalesItem();
                    $saleItem->sale_id = $sale->id;
                    $saleItem->item_name = $data->name;
                    if ($request->test_discount > 0) {
                        $saleItem->item_discount = $data->discount;
                        $saleItem->item_discount_type = $data->discount . 'Rs';
                        $saleItem->discount_reason = $data->dS;
                        //$consultant_amount = ($value['price'] * $value['consultant_percentage'])/100;
                        $withDiscount = $data->rate - $data->discount;
                        $consultant_amount = ($withDiscount * $data->consultant_amount) / 100;
                        $saleItem->consultant_amount = round($consultant_amount);
                    } else if ($sale->discount > 0) {
                        $divideDiscount = ($sale->discount) / sizeof($request->order_list);
                        $divideDiscount = round($divideDiscount);
                        $saleItem->item_discount = $divideDiscount;
                        $saleItem->item_discount_type = $divideDiscount . 'Rs';
                        $saleItem->discount_reason = (int) $request->discountReason;
                        if($request->transaction_id != ""){
                            $easy_paisa = new \app\models\EasyPaisa;
                            $easy_paisa->transaction_id = $request->transaction_id;
                            $easy_paisa->sale_id = $sale->id;
                            $easy_paisa->save();
                        }

                        //$consultant_amount = ($value['price'] * $value['consultant_percentage'])/100;
                        $withDiscount = $data->rate - $divideDiscount;
                        $consultant_amount = ($withDiscount * $data->consultant_amount) / 100;
                        $saleItem->consultant_amount = round($consultant_amount);
                    } else {
                        $saleItem->item_discount = 0;
                        $saleItem->item_discount_type = '0Rs';
                        if($request->mop[0]->id == MOP::EASY_PAISA) {
                            $saleItem->discount_reason = DiscountKey::EASY_PAISA;
                        }
                        else if($request->mop[0]->id == MOP::JAZZ_CASH) {
                            $saleItem->discount_reason = DiscountKey::JAZZ_CASH;
                        }
                        $consultant_amount = ($data->rate * $data->consultant_amount) / 100;
                        $saleItem->consultant_amount = round($consultant_amount);
                    }
                    $saleItem->item_id = $data->id;
                    $saleItem->item_price = $data->rate;
                    $saleItem->created_by = Yii::$app->user->id;
                    $saleItem->created_on = date("Y-m-d H:i:s");
                    $saleItem->status = "1";
                    $saleItem->save();
                    // push_notification::send_push_notification(
                    // str_replace(' ', '', Helper::getDepartmentByItemID($saleItem->sale_id, $saleItem->item_id)),
                    // 'my-event-1'
                    // );
                }
                $paid = 0;
                foreach ($request->mop as $data) {
                    if ($data->value > 0) {
                        $payments = new Payments();
                        $payments->sale_id = $sale->id;
                        $payments->mop_id = $data->id;
                        if ($data->value >= $sale->grand_total) {
                            $payments->amount = $sale->grand_total;
                        } else {
                            $payments->amount = $data->value;
                        }
                        $payments->pos_paid = $data->value;
                        $payments->pos_balance = ($data->value - $sale->grand_total);
                        // $payments->discount_reason = $request->discountReason;
                        $payments->discount = $sale->discount;
                        $payments->discount_type = $sale->discount_type;
                        $paymentLastInvoice = Payments::find()->select('reference_no')->orderBy(['id' => SORT_DESC])->one();
                        $str = $paymentLastInvoice->reference_no;
                        preg_match_all('!\d+!', $str, $matches);
                        if ($matches[0][0] == 0) {
                            $matches = 100;
                        } else {
                            $matches = $matches[0][0];
                        }
                        $invoice_no = 'ADC/PAY/' . ($matches + 1);
                        $payments->reference_no = $invoice_no;
                        $payments->payment_status = "1"; //Received;
                        $payments->status = "1";
                        $payments->created_by = Yii::$app->user->id;
                        $payments->created_on = date("Y-m-d H:i:s");
                        $payments->save();
                        $paid = $data->value;
                    }
                }
                //Send SMS
                // $this->sendSMS($sale->patient->phone_no, "Dear Patient,
//Thank you for visiting Abrar Diagnostic Centre. Your Receipt # " . $sale->invoice_no . " and Paid Amount is " . $paid . ". Please collect your reports after 24 hours.");
                $response['id'] = $sale->id;
                $response['status'] = "True";
                echo json_encode($response);
            } else {
                $response['status'] = "False";
                echo json_encode($response);
            }
        } else {
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
            $sale = Sales::findOne($sale_id);
            $sale->hospital_id = 1;
            $sale->patient_id = $request->patient_id;
            $sale->referred_doctor_id = $request->referral_doctor_id;
            $sale->total = $request->total;
            if ($request->test_discount > 0) {
                $sale->discount = $request->test_discount;
                $sale->discount_type = $request->test_discount . 'Rs';
            } else {
                $sale->discount = $request->discount;
                $sale->discount_type = $request->discount_type;
            }
            $sale->tax = $request->tax;
            $sale->grand_total = $request->grand_total;
            $sale->total_items = $request->total_items;

            // $request->discount;
            // $request->discount_type;

            if ($request->mop[0]->value >= $request->grand_total) {
                $sale->paid_amount = $request->grand_total;
                $sale->payment_status = "1"; //Paid
            } else if ($request->mop[0]->value == 0) {
                $sale->paid_amount = $request->mop[0]->value;
                $sale->payment_status = "0"; //Due Amount
            } else {
                $sale->paid_amount = $request->mop[0]->value;
                $sale->payment_status = "2"; //Patrial
            }

            //$sale->change_amount = $request->grand_total - $request->mop[0]->value;
            //Generate Unique Invoice ID
//            $saleLastInvoice = Sales::find()->select('invoice_no')->orderBy(['id' => SORT_DESC])->one();
//            $str = $saleLastInvoice->invoice_no;
//            preg_match_all('!\d+!', $str, $matches);
//            if ($matches[0][0] == 0) {
//                $matches = 100;
//            } else {
//                $matches = $matches[0][0];
//            }
            $sale->sale_status = "1";
            $sale->status = "1";
            $sale->created_by = Yii::$app->user->id;
            $sale->created_on = date("Y-m-d H:i:s");
            if ($sale->save()) {
                $saleItems = SalesItem::find()->where(['sale_id' => $sale_id])->all();
                foreach ($saleItems as $item) {
                    $item->status = '0';
                    $item->save();
                }
                foreach ($request->order_list as $data) {
                    $saleItem = new SalesItem();
                    $saleItem->sale_id = $sale->id;
                    $saleItem->item_name = $data->name;
                    if ($request->test_discount > 0) {
                        $saleItem->item_discount = $data->discount;
                        $saleItem->item_discount_type = $data->discount . 'Rs';
                        $saleItem->discount_reason = $data->dS;
                        //$consultant_amount = ($value['price'] * $value['consultant_percentage'])/100;
                        $withDiscount = $data->rate - $data->discount;
                        $consultant_amount = ($withDiscount * $data->consultant_amount) / 100;
                        $saleItem->consultant_amount = round($consultant_amount);
                    } else if ($sale->discount > 0) {
                        $divideDiscount = ($sale->discount) / sizeof($request->order_list);
                        $divideDiscount = round($divideDiscount);
                        $saleItem->item_discount = $divideDiscount;
                        $saleItem->item_discount_type = $divideDiscount . 'Rs';
                        $saleItem->discount_reason = (int) $request->discountReason;
                        //$consultant_amount = ($value['price'] * $value['consultant_percentage'])/100;
                        $withDiscount = $data->rate - $divideDiscount;
                        $consultant_amount = ($withDiscount * $data->consultant_amount) / 100;
                        $saleItem->consultant_amount = round($consultant_amount);
                    } else {
                        $saleItem->item_discount = 0;
                        $saleItem->item_discount_type = '0Rs';
                        $consultant_amount = ($data->rate * $data->consultant_amount) / 100;
                        $saleItem->consultant_amount = round($consultant_amount);
                    }
                    $saleItem->item_id = $data->id;
                    $saleItem->item_price = $data->rate;
                    $saleItem->created_by = Yii::$app->user->id;
                    $saleItem->created_on = date("Y-m-d H:i:s");
                    $saleItem->status = "1";
                    $saleItem->save();
                    // push_notification::send_push_notification(
                    // str_replace(' ', '', Helper::getDepartmentByItemID($saleItem->sale_id, $saleItem->item_id)),
                    // 'my-event-1'
                    // );
                }
                $paid = 0;
                foreach ($request->mop as $data) {
                    if ($data->value > 0) {
                        $payments = Payments::find()->where(['sale_id' => $sale->id])->one();
                        $payments->sale_id = $sale->id;
                        $payments->mop_id = $data->id;
                        if ($data->value >= $sale->grand_total) {
                            $payments->amount = $sale->grand_total;
                        } else {
                            $payments->amount = $data->value;
                        }
                        $payments->pos_paid = $data->value;
                        $payments->pos_balance = ($data->value - $sale->grand_total);
                        // $payments->discount_reason = $request->discountReason;
                        $payments->discount = $sale->discount;
                        $payments->discount_type = $sale->discount_type;
                        $paymentLastInvoice = Payments::find()->select('reference_no')->orderBy(['id' => SORT_DESC])->one();
                        $str = $paymentLastInvoice->reference_no;
                        preg_match_all('!\d+!', $str, $matches);
                        if ($matches[0][0] == 0) {
                            $matches = 100;
                        } else {
                            $matches = $matches[0][0];
                        }
                        $invoice_no = 'ADC/PAY/' . ($matches + 1);
                        $payments->reference_no = $invoice_no;
                        $payments->payment_status = "1"; //Received;
                        $payments->status = "1";
                        $payments->created_by = Yii::$app->user->id;
                        $payments->created_on = date("Y-m-d H:i:s");
                        $payments->save();
                        $paid = $data->value;
                    }
                }
                //Send SMS
                // $this->sendSMS($sale->patient->phone_no, "Dear Patient,
//Thank you for visiting Abrar Diagnostic Centre. Your Receipt # " . $sale->invoice_no . " and Paid Amount is " . $paid . ". Please collect your reports after 24 hours.");
                $response['id'] = $sale->id;
                $response['status'] = "True";
                echo json_encode($response);
            } else {
                $response['status'] = "False";
                echo json_encode($response);
            }
        }
    }

    public function actionSubmitDepartmentReport() {
        // echo Helper::getLabFormName($_POST['examrequired']);
        // die();
      
        $report = $_POST['report'];
        $new_invoice_id=$_POST['invoice_id'];
        $new_item_id=$_POST['item_id'];
       
        $user_report=new UserReport;
        $user_report->invoice_no=$new_invoice_id;
        $patient_data = Sales::find()->where(['=', 'invoice_no',$new_invoice_id])->one();
        

        // $rows = (new Sales)->where(['invoice_no', $new_invoice_id])->one();
        // $rows = Sales::where(['invoice_no' => $new_invoice_id])->one();
     
    //    var_dump($rows); 

        $user_report->item_id=$new_item_id;
        $user_report->report=$report;
        $user_report->patient_id=$patient_data->patient_id;
        $user_report->save();
       
        $id = $_POST['sale_item_id'];
        $push = 0;
        $extra = 0;
        if (isset($_POST['product'])) {
            $push = 1;
            foreach ($_POST['product'] as $key => $value) {
                $extra_sale = new ExtraSaleItem();
                $additional = AdditionalCostItem::findOne($value);
                $extra_sale->item_id = $additional->id;
                $extra_sale->item_name = $additional->product;
                $extra_sale->item_rate = $additional->rate;
                $extra_sale->item_quantity = $_POST['qty'][$key];
                $extra_sale->item_description = $_POST['description'][$key];
                $extra_sale->status = "1";
                $extra_sale->sale_item_id = $id;
                $extra_sale->created_by = Yii::$app->user->id;
                $extra_sale->created_on = date("Y-m-d H:i:s");
                $extra_sale->save();
                $extra = $extra + ($additional->rate * $_POST['qty'][$key] );
            }
        }

        if (isset($_POST['opt_product'])) {
            foreach ($_POST['opt_product'] as $key => $data) {
                $extra_sale_option = new ExtraSaleOptionItem();
                $optional = OptionalItem::findOne($data);
                $extra_sale_option->item_id = $optional->id;
                $extra_sale_option->product_name = $optional->product_name;
                $extra_sale_option->product_quantity = $_POST['opt_qty'][$key];
                $extra_sale_option->sale_item_id = $id;
                $extra_sale_option->created_by = Yii::$app->user->id;
                $extra_sale_option->created_on = date("Y-m-d H:i:s");
                $extra_sale_option->save();
            }
        }

        $lab_form_submit = new LabFormSubmit();
        $lab_form_submit->lab_form_id = $_POST['examrequired'];
        $lab_form_submit->sale_item_id = $_POST['sale_item_id'];
        $lab_form_submit->lab_form_name = Helper::getLabFormName($_POST['examrequired']);
        $lab_form_submit->lab_form_title = Helper::getLabFormTitle($_POST['examrequired']);
        $lab_form_submit->item_name_id = $_POST['ItemID'];
        $lab_form_submit->item_name_name = $_POST['ItemName'];
        $lab_form_submit->patient_id = $_POST['patientID'];
        $lab_form_submit->created_on = date("Y-m-d H:i:s");
        $lab_form_submit->created_by = Yii::$app->user->id;
        $lab_form_submit->save();

        // echo "<pre>";
        // print_r($lab_form_submit->errors);
        // echo "</pre>";
        // die();

        if (isset($_POST['form_values_id'])) {
            foreach ($_POST['form_values_id'] as $key => $data) {
                $lab_form_field_submit = new LabFormFieldSubmit();
                $temp = Helper::getLabFormField($key);
                $lab_form_field_submit->lab_form_submit_id = $lab_form_submit->id;
                $lab_form_field_submit->name = $temp->name;
                $lab_form_field_submit->result = $data;
                $lab_form_field_submit->unit = $temp->unit;
                $lab_form_field_submit->reference_range = $temp->reference_range;
                $lab_form_field_submit->header_name = $temp->header_name;
                $lab_form_field_submit->created_by = Yii::$app->user->id;
                $lab_form_field_submit->created_on = date("Y-m-d H:i:s");
                $lab_form_field_submit->save();
            }
        }

        $sale_item = SalesItem::findOne($id);
        $sale_item->comment = $_POST['comment'];
        $sale_item->report = $_POST['report'];
      
        $sale_item->test_status = "2"; //Complete
        $sale_item->updated_by = Yii::$app->user->id;
        $sale_item->updated_on = date("Y-m-d H:i:s");
        $sale_item->save();
      
        //return json_encode($sale_item->errors);
        //Push Status
        if ($push == 1) {
            $sale = Sales::findOne($sale_item->sale_id);
            $sale->depart_push_status = 1;
            if (!$sale->extra_charges) {
                $sale->extra_charges = 0;
            }
            $sale->extra_charges = $sale->extra_charges + $extra;
            $sale->grand_total = $sale->grand_total + $extra;
            echo $sale->paid_amount;
            if ($sale->paid_amount > 0) {
                $sale->payment_status = "2";
            }
            $sale->updated_by = Yii::$app->user->id;
            $sale->updated_on = date("Y-m-d H:i:s");
            $sale->save();
        }
    }

    public function actionGetOptionalItems() {
        $q = $_GET['q'];
        $model = OptionalItem::find()->orWhere(['like', 'product_name', $q])->all();
        $option_array = array();
        foreach ($model as $key => $value) {
            $option['id'] = $value['id'];
            $option['name'] = $value['product_name'];
            $option['qty'] = $value['default_quantity'];
            $option_array[] = $option;
        }
        //$response['optional_products'] = $option_array;
        echo json_encode($option_array);
    }

    public function actionSendDiscountSms() {
        $id = $_GET['id'];
        $sales = \app\models\Sales::find()
                        ->joinWith('saleitems')
                        ->joinWith('payments')
                        ->joinWith('patient')
                        ->joinWith('referred')
                        ->joinWith('payments.mop')
                        ->andWhere(['sale.id' => $id])->one();
        $discountKeys = array();
        foreach ($sales->saleitems as $item) {
            $discount_key = DiscountKey::findOne($item->discount_reason);
            $val[$discount_key->key_name] = $item->item_discount;
            //$val[$item->discount_reason] = $item->item_discount;
            $discountKeys[] = $val;
            unset($val);
        }
        $sumArray = array();
        foreach ($discountKeys as $k => $subArray) {
            foreach ($subArray as $id => $value) {
                $sumArray[$id] += $value;
            }
        }
        $discount_names = array_filter($sumArray);
        $msg = "Discount Alert \n";
        $msg .= 'Patient Name : ' . $sales->patient->name . "\n";
        $msg .= 'Paid Amount : ' . $sales->paid_amount . "\n";
        $msg .= 'Discount Amount : ' . $sales->discount . "\n";
        foreach ($discount_names as $key => $amount) {
            $msg .= 'Approved by : ' . $key . " :" . $amount . "\n";
        }
        $msg .= 'Date/Time : ' . datetime::printBill($sales->created_on) . "\n";
        $msg .= 'Enter By : ' . Yii::$app->user->identity->username . "\n";
        if (YII_ENV_PROD) {
            $this->sendSMS("03215177399", $msg);
        } else {
            $this->sendSMS("03215177399", $msg);
        }
    }

    public static function sendSMS($phone, $message) {
        $developer = 'live';
        if ($developer == 'live') {
            $url = 'https://pk.eocean.us/APIManagement/API/RequestAPI?user=asandadc&pwd=ADy%2fYIdG332xntfIlxFSui5VSPor1RFbWNGb4FBLfpmpCBYU%2fbmh0xZg6A0TkoHB1w%3d%3d&sender=AS%20and%20ADC&reciever=' . urlencode($phone) . '&msg-data=' . urlencode($message) . '&response=string';
        } else {
            $url = '';
            //$url = 'http://pk.eocean.us/APIManagement/API/RequestAPI?user=maaliksoft&pwd=AP5mfXnlsGqimiAisGtoSq%2bLmQGHtKJk2ch5w2ehNv%2fKqOV2lXrOmgXMWCtlh9hUKg%3d%3d&sender=AS%20and%20ADC&reciever=03345363084'.'&msg-data='.urlencode($message) .'&response=string';
        }
        $cSession = curl_init();
        curl_setopt($cSession, CURLOPT_URL, $url);
        curl_setopt($cSession, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cSession, CURLOPT_HEADER, false);
        $result = curl_exec($cSession);
        curl_close($cSession);

        if (strpos($result, 'Message accepted for delivery') !== false) {
            $status = 'sent';
            return true;
        } else if (strpos($result, 'API Execute Successfully') !== false) {
            $status = 'sent';
            return true;
        } else {
            $status = 'failure';
            return true;
        }
    }

    //Select 2 Search
    public function actionPatientList($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, name AS text')
                    ->from('patient')
                    ->where(['like', 'name', $q])
                    ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Patient::find($id)->name];
        }
        return $out;
    }

    public function actionRefferedList($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, name AS text')
                    ->from('referred_doctor')
                    ->where(['like', 'name', $q])
                    ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => ReferredDoctor::find($id)->name];
        }
        return $out;
    }

    public function actionTestList($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, name AS text')
                    ->from('item_name')
                    ->where(['like', 'name', $q])
                    ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => ItemName::find($id)->name];
        }
        return $out;
    }

    public function actionTestCategoryList($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, name AS text')
                    ->from('item_category')
                    ->where(['like', 'name', $q])
                    ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => ItemCategory::find($id)->name];
        }
        return $out;
    }

    public function actionRefundBill() {
        if (isset($_GET['valid'])) {
            $total_amount = 0;
            $total_refund_surcharges = 0;
            //$total_discount = 0;
            foreach (array_keys($_GET['valid']) as $key) {
                $id = $_GET['id'][$key];
                $refund_charge = $_GET['item'][$key];
                $saleItem = SalesItem::findOne($id);
                $total = $saleItem->item_price - $saleItem->item_discount;
                if (empty($refund_charge)) {
                    $refund_charge = 0;
                }
                $refund_cal = $total - $refund_charge;
                $saleItem->refund_amount = $refund_cal;
                $saleItem->refund_surcharge = $refund_charge;
                $saleItem->refund_on = date("Y-m-d H:i:s");
                $saleItem->refund_by = Yii::$app->user->id;
                $saleItem->test_status = '3';
                $saleItem->consultant_amount = 0;
                $saleItem->save();
                $sale_id = $saleItem->sale_id;
                $total_amount = $total_amount + $refund_cal;
                $total_refund_surcharges = $total_refund_surcharges + $refund_charge;
                //$total_discount = $total_discount + $saleItem->item_discount;
            }
            $sale = Sales::findOne($sale_id);
            $sale->refund_charges = $total_refund_surcharges + $sale->refund_charges;
            $sale->refund_amount = $total_amount + $sale->refund_amount;
            $sale->paid_amount = $sale->paid_amount - $total_amount;
            //$sale->discount = $sale->discount - $total_discount ;
            //$sale->discount_type = $sale->discount_type.'Rs';
            $check = SalesItem::find()->where(['sale_id' => $sale->id])->andWhere(['test_status' => 3])->count();
            $count = SalesItem::find()->where(['sale_id' => $sale->id])->count();
            if ($check == $count) {
                $sale->sale_status = '2';
            } else {
                $sale->sale_status = '3';
            }
            $sale->save();
            $payment = new Payments();
            $payment->sale_id = $sale->id;
            $paymentLastInvoice = Payments::find()->select('reference_no')->orderBy(['id' => SORT_DESC])->one();
            $str = $paymentLastInvoice->reference_no;
            preg_match_all('!\d+!', $str, $matches);
            if ($matches[0][0] == 0) {
                $matches = 100;
            } else {
                $matches = $matches[0][0];
            }
            $invoice_no = 'ADC/REFUND/' . ($matches + 1);
            $payment->reference_no = $invoice_no;
            $payment->payment_status = "3";
            $payment->mop_id = 1;
            $payment->amount = $total_amount;
            $payment->status = "1";
            $payment->created_on = date("Y-m-d H:i:s");
            $payment->created_by = Yii::$app->user->id;
            if ($payment->save()) {
                echo "Refund Successfully";
            }
        }
    }

    public function actionLabFormSubmit() {
        $json = file_get_contents('php://input');
        $json_decode = json_decode($json);
        $delete = LabFormField::find()->where(['lab_form_id' => $json_decode[0][0]])->all();
        foreach ($delete as $key => $value) {
            LabFormField::findOne($value->id)->delete();
        }
        foreach ($json_decode as $key => $value) {
            $lab_form_field = new LabFormField();
            $lab_form_field->header_name = $value[1];
            $lab_form_field->name = $value[2];
            $lab_form_field->unit = $value[4];
            $lab_form_field->reference_range = $value[5];
            $lab_form_field->sort = $key;
            $lab_form_field->created_on = date("Y-m-d H:i:s");
            $lab_form_field->created_by = Yii::$app->user->id;
            $lab_form_field->lab_form_id = $value[0];
            $lab_form_field->save();
        }
        echo true;
    }

    public function actionGetPendingTest() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $assign_department = explode(',', Yii::$app->user->identity->assign_department);
        $return_pending_test = array();
        $count = SalesItem::find()->select(['sale_item.id', 'sale_item.sale_id', 'sale_item.item_id'])
                        //->joinWith(['sale.patient'])
                        ->joinWith(['sale' => function(ActiveQuery $query) {
                                return $query->select(['sale.id', 'sale.patient_id']);
                            }])
                                ->joinWith(['sale.patient' => function(ActiveQuery $query) {
                                        return $query->select(['patient.id', 'patient.name']);
                                    }])
                                        ->joinWith(['item.category.department'])
                                        ->where(['in', 'department.id', $assign_department])
                                        ->andWhere(['test_status' => "1"])->count();

                        $getpendingtest = SalesItem::find()->select(['sale_item.id', 'sale_item.sale_id', 'sale_item.item_id'])
                                        //->joinWith(['sale.patient'])
                                        ->joinWith(['sale' => function(ActiveQuery $query) {
                                                return $query->select(['sale.id', 'sale.patient_id']);
                                            }])
                                                ->joinWith(['sale.patient' => function(ActiveQuery $query) {
                                                        return $query->select(['patient.id', 'patient.name']);
                                                    }])
                                                        ->joinWith(['item.category.department'])
                                                        ->where(['in', 'department.id', $assign_department])
                                                        ->andWhere(['test_status' => "1"])
                                                        ->orderBy(['id' => SORT_DESC])->limit(20)
                                                        ->asArray()->all();

                                        $return_pending_test['status'] = true;
                                        $return_pending_test['data'] = array();
                                        $return_pending_test['count'] = $count;
                                        $return_pending_test['message'] = 'Data Fetch Successfully';
                                        foreach ($getpendingtest as $key => $value) {
                                            $return_pending_test['data'][$key]['id'] = $value['id'];
                                            $return_pending_test['data'][$key]['patient_name'] = $value['sale']['patient']['name'];
                                            $return_pending_test['data'][$key]['test_name'] = $value['item']['name'];
                                        }

                                        return $return_pending_test;
                                        // echo "<pre>";
                                        // print_r($return_pending_test);
                                        // // print_r($getpendingtest);
                                        // echo "</pre>";
                                    }

                                    public function actionSearchProduct() {
                                        $query = $_GET['query'];
                                        $model = \app\models\ProductVariant::find()->joinWith(['product'])->joinWith(['variant'])->orWhere(['like', 'variant.name', $query])->orWhere(['like', 'product.name', $query])->orWhere(['like', 'product_variant.code', $query])->orWhere(['like', 'product.code', $query])->all();
                                        ////print_r($model);
                                        //return 1;
                                        $product_array = array();
                                        foreach ($model as $key => $value) {
                                            $product['variant_id'] = $value['variant_id'];
                                            $product['name'] = $value['product']['name'];
                                            if (!empty($value['variant']['name'])) {
                                                $product['code'] = $value['code'];
                                            } else {
                                                $product['code'] = $value['product']['code'];
                                            }
                                            $product['variant_name'] = $value['variant']['name'];
                                            $product['product_id'] = $value['product']['id'];
                                            $product['id'] = $value['product']['id']."_".$value['variant_id'];
                                            $product['product_total'] = 0;
                                            $product['quantity'] = 0;
                                            $product['cost'] = 0;
                                            $product['discount'] = 0;
                                            $product['tax'] = 0;
                                            $product_array[] = $product;
                                        }


                                        $response['product'] = $product_array;

                                        echo json_encode($product_array);
                                    }

                                    public function actionAllUnit() {
                                        $model = \app\models\SiUnit::find()->all();

                                        $unit_array = array();
                                        foreach ($model as $key => $value) {
                                            $unit['id'] = $value['id'];
                                            $unit['name'] = $value['name'];
                                            $unit_array[] = $unit;
                                        }


                                        $response['unit'] = $unit_array;

                                        echo json_encode($unit_array);
                                    }

                                    public function actionUpdateDepartmentReport() {
                                        // echo Helper::getLabFormName($_POST['examrequired']);
                                        // die();
                                         $id = $_POST['sale_item_id'];
                                        $push = 0;
                                        $extra = 0;
                                        $labFormSubmitId = LabFormSubmit::find()->where(['sale_item_id'=>$id])->one();
                                        $LabFormFieldSubmit = LabFormFieldSubmit::find()->where(['lab_form_submit_id' => $labFormSubmitId->id])->all();
//                                         echo "<pre>";
//                                         print_r($labFormSubmitId);
//                                         echo "</pre>";
//                                         die();
                                        $i = 0;
                                        if (isset($_POST['form_values_id'])) {
                                            foreach ($_POST['form_values_id'] as $key => $data) {
                                                $lab_form_field_submit = LabFormFieldSubmit::findOne($LabFormFieldSubmit[$i]->id);
                                                $lab_form_field_submit->result = $data;
                                                $lab_form_field_submit->save();
                                                $i++;
                                            }
                                        }
                                        //updated by nabeel on 02-03-22
                                        if (!empty($_POST["comment"]) && !ctype_space($_POST["comment"])) {
                                            $sale_item = SalesItem::findOne($id);
                                            $sale_item->comment = $_POST['comment'];
                                            $sale_item->updated_by = Yii::$app->user->id;
                                            $sale_item->updated_on = date("Y-m-d H:i:s");
                                            $sale_item->save();
                                        }
                                        return 1;

                                    }

                                }
