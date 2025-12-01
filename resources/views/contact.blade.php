@extends('layouts.app')
@section('content')

<div class="flex-grow flex justify-center items-center py-12">
    <div class="flex gap-12 items-center">

        
        <img src="/images/contact_question.png" class="w-[800px] h-auto object-contain">

        
        <div class="w-full max-w-xl bg-white shadow-md rounded-xl p-8">

            <h2 class="text-3xl font-bold mb-2 text-gray-700">Contact Us</h2>
            <p class="text-gray-500 mb-6 text-sm">We aim to respond promptly to all enquiries. Watch out for an email!</p>

            <form class="space-y-5">

                <input 
                    type="text"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Your name"
                >

                <input 
                    type="email"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Your email"
                >

                <textarea
                    rows="6"
                    minlength="50" 
                    maxlength="500"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none resize-none"
                    placeholder="Your message"
                ></textarea>

                <button
                    type="submit"
                    class="w-full bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-800 transition"
                >
                    Send Message
                </button>

            </form>
        </div>

    </div>
</div>

@endsection