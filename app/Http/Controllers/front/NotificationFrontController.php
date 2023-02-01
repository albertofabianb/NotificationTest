<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class NotificationFrontController extends Controller
{
    private $client;

    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    public function index ()
    {
        $categories = $this->getCategories();
        $log = $this->getLog();
        return view('notificationFront.index', ['categories' => $categories, 'log' => $this->formatLog($log)]);
    }

    public function publish(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'message' => 'required'
        ]);

        $url = getenv('URL_BACKEND').'api/notifier';
        try {
            $response = $this->client->request('POST', $url, [
                'form_params' => [
                    'category_id' => $request->input('category_id'),
                    'message' => $request->input('message')
                ]
            ]);

        } catch (\Exception $e) {
            throw $e;
        }
        return redirect('/');
    }

    public function getCategories()
    {
        $url = getenv('URL_BACKEND').'api/categories';
        $response = $this->client->request('GET', $url, []);
        return json_decode($response->getBody(), false);
    }

    public function formatLog($log){

        $log_text = "";
        foreach($log as $notification => $value1) {
            list($created_at, $category, $message) = explode('---', $notification);
            $log_text .= '['.$created_at. ']: ' . $category . ': "' . $message . '" >> SENT TO:<br>';
            foreach($log[$notification] as $name => $value2){
                $log_text .= '- '.$name.' by ';
                foreach($log[$notification][$name] as $channel => $value3) {
                    $status = $value3 ? '<span style="color:green">ok</span>' : '<span style="color:red">failed</span>';
                    $channels[] = $channel.' '.$status;
                }
                $log_text .= implode(', ', $channels).'<br>';
                $channels = [];
            }
        }
        return $log_text;
    }

    private function getLog(){
        $response =  $this->client->request('GET', getenv('URL_BACKEND').'api/get_log');
        $log = json_decode($response->getBody(), true, 5,  JSON_THROW_ON_ERROR);
        return $log;
    }
}
