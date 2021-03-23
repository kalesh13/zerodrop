<?php

namespace App\Http\Controllers\Subscribers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Subscriber\ISubscriberRepo;

class SubscriberController extends Controller
{
    /**
     * Application subscriber repository.
     * 
     * @var \App\Repositories\Subscriber\ISubscriberRepo
     */
    protected $subscriber_repo;

    /**
     * Controller that takes care of subscribers and subscription status'.
     * 
     * @param \App\Repositories\Subscriber\ISubscriberRepo $subscriber_repo
     */
    public function __construct(ISubscriberRepo $subscriber_repo)
    {
        $this->subscriber_repo = $subscriber_repo;
    }

    /**
     * Subscribes an email address to the application email list.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function subscribe(Request $request)
    {
        $subscriber = $this->subscriber_repo->subscribe($request->input('email'));

        if ($subscriber) {
            return $this->getSubscriptionView(true, 'Subscribed to our email list.');
        }
        return $this->getSubscriptionView(false, 'Error subscribing to our email list.');
    }

    /**
     * Unsubscribes an email address from the application email list.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function unsubscribe(Request $request)
    {
        $subscriber = $this->subscriber_repo->unsubscribe($request->input('email'));

        if ($subscriber) {
            return $this->getSubscriptionView(true, 'Unsubscribed from our email list.');
        }
        return $this->getSubscriptionView(false, 'Error unsubscribing from our email list.');
    }

    /**
     * Returns the subscription status page for the given parameters.
     * 
     * @param bool $success
     * @param string $message
     * @return \Illuminate\View\View
     */
    protected function getSubscriptionView($success, $message)
    {
        return view('subscribe')->with('success', $success)->with('message', $message);
    }
}
