<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Cabinets;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        /*
         * Yii::$app->db->createCommand('SELECT * FROM `Cabinets` WHERE `cabnetFloor` = 1 ') ->queryAll();
         * $query1 = (new \yii\db\Query())
         *  ->from('Cabinets')
         * ->where(['cabnetFloor' => 1])
         * ->all();
         */
        $query = Cabinets::find()
            ->where(['cabnetFloor' => 1])
            ->all();
        
        return $this->render('index', [
            'firstFloorCabinets' => $query,
                ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays map pages.
     *
     * @return string
     */    
    public function actionMap2()
    {
        //Yii::$app->db->createCommand('SELECT * FROM `Cabinets` WHERE `cabnetFloor` = 2 ') ->queryAll();
        $query = Cabinets::find()
            ->where(['cabnetFloor' => 2])
            ->all();
        
        return $this->render('map2', ['secondFloorCabinets' => $query]);
    }
    
    public function actionMap3()
    {
        //Yii::$app->db->createCommand('SELECT * FROM `Cabinets` WHERE `cabnetFloor` = 3 ') ->queryAll();
        $query = Cabinets::find()
            ->where(['cabnetFloor' => 3])
            ->all();
        
        return $this->render('map3', ['thirdFloorCabinets' => $query]);
    }
    
    public function actionMap4()
    {
        //Yii::$app->db->createCommand('SELECT * FROM `Cabinets` WHERE `cabnetFloor` = 4 ') ->queryAll();
        $query = Cabinets::find()
            ->where(['cabnetFloor' => 4])
            ->all();
        
        return $this->render('map4', ['fourthFloorCabinets' => $query]);
    }
}
