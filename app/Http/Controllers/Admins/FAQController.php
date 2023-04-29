<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins\FAQ;
use App\Http\Requests\Admin\FaqRequest;

class FAQController extends Controller
{
    public function faqView()
    {
        $faqs = FAQ::all();
        return view('admin.faq.faqView', compact('faqs'));
    }
    public function addFaq()
    {
        return view('admin.faq.add_faq');
    }

    public function storeFaq(FaqRequest $request)
    {
        $validatedData = $request->validated();
        $faq = new Faq();
        $faq->question            = $validatedData['question'];
        $faq->answer            = $validatedData['answer'];
        $faq->save();
        $notification = array('message' => 'Faq recorded', 'alert-type' => 'success');
        return redirect()->route('admin.manage.faq')->with($notification);
    }

    public function deleteFaq($id)
    {

        Faq::FindOrFail($id)->delete();
        $notification = array('message' => 'Faq deleted', 'alert-type' => 'info');
        return redirect()->route('admin.manage.faq')->with($notification);
    }

    public function editFaq($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.editFaq', compact('faq'));
    }
    public function updateFaq(FaqRequest $request, $id)
    {
        $validatedData = $request->validated();
        $faq = Faq::findOrFail($request->id);
        $faq->question = $validatedData['question'];
        $faq->answer = $validatedData['answer'];
        $faq->save();
        $notification = array('message' => 'Faq updated', 'alert-type' => 'success');
        return redirect()->route('admin.manage.faq')->with($notification);
    }
}
