@extends('layouts.app')
@section('content')

<div class="flex-grow flex justify-center items-center py-12">
    <div class="flex gap-12 items-center">

        <img src="/images/contact_question.png" class="w-[800px] h-auto object-contain">

        <div class="w-full max-w-xl bg-white shadow-md rounded-xl p-8">

            <h2 class="text-3xl font-bold mb-2 text-gray-700">Contact Us</h2>
            <p class="text-gray-500 mb-6 text-sm">
                We aim to respond promptly to all enquiries. Watch out for an email!
            </p>

            <!-- Contact information -->
            <div class="mb-8 text-gray-600 text-sm space-y-2">
                <p class="flex items-center gap-2">
                    📍 <span>45 Gamer's Avenue, Birmingham, UK</span>
                </p>
                <p class="flex items-center gap-2">
                    📞 <span>+44 7512 345678</span>
                </p>
                <p class="flex items-center gap-2">
                    📧 <span>bridge14games@gmail.com</span>
                </p>
                <p class="flex items-center gap-2">
                    🕒 <span>Mon–Fri: 9am – 6pm | Sat-Sun: 10am - 5pm</span>
                </p>
            </div>
            
            <!-- Small map of where area is based -->
            <div class="mb-6">
                <iframe
                    width="100%"
                    height="180"
                    style="border:0; border-radius: 10px;"
                    loading="lazy"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9718.410987691119!2d-1.899497!3d52.489471!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4870bc8c33f4fd65%3A0x0!2sBirmingham%20City%20Centre!5e0!3m2!1sen!2uk!4v1700000000001">
                </iframe>
            </div>


            <!-- Success message when user submits the contact form -->
            @if(request()->has('success'))
                <div class="mb-4 bg-green-100 text-green-700 text-sm px-4 py-2 rounded">
                    Your message has been sent successfully.
                </div>
            @endif

            <form action="https://api.web3forms.com/submit" method="POST" class="space-y-5">

                <!-- This is required for Web3Forms to work, easier way for forms to be sent to us. -->
                <input
                    type="hidden"
                    name="access_key"
                    value="71e04a53-b0ce-4775-9570-e8ec09d93a3c"
                >

                <!-- Redirect to this webpage when successful when user submits form. -->
                <input
                    type="hidden"
                    name="redirect"
                    value="{{ url('/contact-us') }}?success=1"
                >

                <!-- Input field for Name, presence check is implemented. -->
                <input
                    type="text"
                    name="name"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Your name"
                    required
                >

                <!-- Input field for Email, presence check and format check is implemented. -->
                <input
                    type="email"
                    name="email"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Your email"
                    required
                >

                <!-- Input field for Message, presence check and length check is implemented. -->
                <!-- Minimum Characters: 50 | Maximum Characters: 500 -->
                <textarea
                    name="message"
                    rows="6"
                    minlength="50"
                    maxlength="500"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none resize-none"
                    placeholder="Your message"
                    required
                ></textarea>

                <!-- Submit button for submitting the data. -->
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

<script>
    // Remove the green "Successful Submission" message once website is refreshed or navigated away from.
    if (window.location.search.includes('success=1')) {
        window.history.replaceState({}, document.title, "/contact");
    }
</script>
