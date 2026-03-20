@extends('layouts.app')
@section('content')

<div class="flex-grow flex justify-center items-center py-12">

    <div class="flex gap-12 items-center">

        <img src="/images/contact_question.png" class="w-[800px] h-auto object-contain">

        <div class="w-full max-w-xl 
        bg-[#efeaff] dark:bg-[#2c2f66] 
        shadow-2xl rounded-2xl p-8 
        text-black dark:text-white">

            <h2 class="text-3xl font-bold mb-2">Contact Us</h2>

            <p class="text-black/70 dark:text-gray-300 mb-6 text-sm">
                We aim to respond promptly to all enquiries. Watch out for an email!
            </p>

            <div class="mb-8 text-black dark:text-gray-200 text-sm space-y-2">
                <p class="flex items-center gap-2">📍 <span>45 Gamer's Avenue, Birmingham, UK</span></p>
                <p class="flex items-center gap-2">📞 <span>+44 7512 345678</span></p>
                <p class="flex items-center gap-2">📧 <span>bridge14games@gmail.com</span></p>
                <p class="flex items-center gap-2">🕒 <span>Mon–Fri: 9am – 6pm | Sat-Sun: 10am - 5pm</span></p>
            </div>

            <div class="p-[2px] rounded-xl bg-[#6163b3]">
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

            @if(request()->has('success'))
                <div class="mb-4 mt-4 bg-[#85c061]/20 text-[#85c061] text-sm px-4 py-2 rounded">
                    Your message has been sent successfully.
                </div>
            @endif

            <form action="https://api.web3forms.com/submit" method="POST" class="space-y-5 mt-4">

                <input type="hidden" name="access_key" value="71e04a53-b0ce-4775-9570-e8ec09d93a3c">
                <input type="hidden" name="redirect" value="{{ url('/contact-us') }}?success=1">

                <input
                    type="text"
                    name="name"
                    placeholder="Your name"
                    required
                    class="w-full 
                    bg-[#faf8ff] dark:bg-[#292755] 
                    border border-[#cfc6ff] dark:border-[#6163b3] 
                    text-black dark:text-white 
                    rounded-lg px-4 py-2 
                    focus:ring-2 focus:ring-[#6163b3] focus:outline-none"
                >

                <input
                    type="email"
                    name="email"
                    placeholder="Your email"
                    required
                    class="w-full 
                    bg-[#faf8ff] dark:bg-[#292755] 
                    border border-[#cfc6ff] dark:border-[#6163b3] 
                    text-black dark:text-white 
                    rounded-lg px-4 py-2 
                    focus:ring-2 focus:ring-[#6163b3] focus:outline-none"
                >

                <textarea
                    name="message"
                    rows="6"
                    minlength="50"
                    maxlength="500"
                    placeholder="Your message"
                    required
                    class="w-full 
                    bg-[#faf8ff] dark:bg-[#292755] 
                    border border-[#cfc6ff] dark:border-[#6163b3] 
                    text-black dark:text-white 
                    rounded-lg px-4 py-2 
                    focus:ring-2 focus:ring-[#6163b3] focus:outline-none resize-none"
                ></textarea>

                <button
                    type="submit"
                    class="w-full
                    bg-[#9d8cd9] hover:bg-[#8b75d7]
                    dark:bg-[#6163b3] dark:hover:bg-[#4c4fa3] 
                    text-white font-semibold px-4 py-2 
                    rounded-lg transition"
                >
                    Send Message
                </button>

            </form>

        </div>

    </div>

</div>

<script>
    if (window.location.search.includes('success=1')) {
        window.history.replaceState({}, document.title, "/contact");
    }
</script>

@endsection