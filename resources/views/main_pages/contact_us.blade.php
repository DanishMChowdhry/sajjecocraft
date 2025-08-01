@extends('layouts.frontend')

@section('title')
    Contact Us
@endsection

@section('content')
<main>
    <div class="mb-4 pb-4"></div>
    <section class="contact-us container">
      <div class="mw-930">
        <h2 class="page-title">CONTACT US</h2>
      </div>
    </section>

    <section class="google-map mb-5">
        <h2 class="d-none">Contact US</h2>
        <!--<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14766.748963716016!2d70.7615402!3d22.2898343!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959cbd301153377%3A0x2fed855d54913762!2sSAJJ%20DECOR!5e0!3m2!1sen!2sin!4v1729324451690!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>-->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3673.9274592765128!2d72.4644024747682!3d22.952898518925732!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e91ecad236e11%3A0xb31c67106d35ec24!2sSajj%20Decor!5e0!3m2!1sen!2sin!4v1744667291067!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <section class="contact-us container">
      <div class="mw-930">
        @if ($branches->count()>0)
        <div class="row mb-5">
@foreach ($branches as $item)
    <div class="col-lg-6">
      <h3 class="mb-4">{{ $item->title }}</h3>
      <p class="mb-4">{{ $item->address }}</p>
      <p class="mb-4">{{ $item->email_address }}<br>{{ $item->phone_number }}</p>
    </div>
    @endforeach
</div>
        @endif

        @include('partial.alert')
      <div class="contact-us__form">
    <form action="{{ route('main_page.send_contact_request') }}" method="POST" name="contact-us-form">
        @csrf
        <h3 class="mb-5">Get In Touch</h3>

        <!-- Name Field -->
        <div class="form-floating my-4">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name *" maxlength="30" required value="{{ old('name') }}">
            <label for="name">Name *</label>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Field -->
        <div class="form-floating my-4">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email address *" maxlength="50" required value="{{ old('email') }}">
            <label for="email">Email address *</label>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Phone Field -->
        <div class="form-floating my-4">
<input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number *"
       pattern="^(\+91)?\d{10}$"
       maxlength="13" required value="{{ old('phone') }}">
            <label for="phone">Phone Number *</label>
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Message Field -->
        <div class="my-4">
            <textarea class="form-control form-control_gray" placeholder="Your Message" id="message" name="message" maxlength="1500" cols="30" rows="8" required>{{ old('message') }}</textarea>
            @error('message')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="my-4">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

      </div>
    </section>
  </main>

@endsection
