@extends('layouts.website.master')
@section('title', $page_title)
@section('content')
<style>
    /* Modern, unified form style */
    .form-label {
        font-weight: 500;
        color: #1a355e;
        font-size: 1rem;
        font-family: 'Poppins', 'Roboto', Arial, sans-serif;
    }
    .form-control input-field {
        font-family: 'Poppins', 'Roboto', Arial, sans-serif;
        color: #212529;
        background-color: #fff;
        border: 1.5px solid #ced4da;
        border-radius: 0.5rem;
        padding: 0.5rem 1.6rem;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-size: 1.6rem !important;
    }
    .form-control input-field:focus {
        border-color: #1a355e;
        box-shadow: 0 0 0 0.1rem rgba(26,53,94,0.08);
        background-color: #fff;
        color: #212529;
    }
    .form-control input-field::placeholder {
        color: #6c757d;
        opacity: 1;
    }
    .btn-warning {
        background: #ffc107;
        color: #1a355e;
        border: none;
        border-radius: 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: 1px;
        transition: background 0.2s, color 0.2s;
    }
    .btn-warning:hover, .btn-warning:focus {
        background: #1a355e;
        color: #fff;
    }
    #card-element {
        background: #fff;
        border: 1px solid #ced4da;
        border-radius: .375rem;
        padding: 10px 12px;
    }
    .input-field {
        border: 1px solid #ffc107;
        padding: var(--text-10) var(--text-30);
    }
    
    .btn{
        padding: var(--text-15) var(--text-30) !important;
    font-size: var(--text-18) !important;

    }
    h2.fs-40 {
        font-size: 4rem !important;
    }

    .paddings{
        padding: 50px 0;
    }

    .signup-form {
        background: linear-gradient(315deg, #4ab0f5, #004b8500);
        box-shadow: 5px 5px 20px 0px rgb(0 0 0 / 21%) !important;
    }
    @media (max-width: 767.98px) {
        .card {
            padding: 1.5rem !important;
        }
        .signup-form {
            padding: 1rem 0;
        }
        .form-label, .form-control input-field {
            font-size: 0.95rem;
        }
    }
</style>

<!-- Banner Section -->

@if(!empty($banner->image))
<section class="inner-banner sign-up" style="background-image: url('{{asset('/admin/assets/images/banner') }}/{{ $banner->image }}');"> 
@else
<section class="inner-banner sign-up" style="background-image: url('{{asset('/admin/assets/images/images.png') }}');" style="width:100%">
@endif
<div class="banner-wrapper position-relative z-1">
    <div class="container">
    <div class="row">
        @include('website.include.social-links') 
        <div class="col-lg-10 col-xl-9" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
        <div class="card">
            <div class="shape-1"></div>
            @if(isset($banner))
                <h1 class="hd-70">{{$banner->name}}</h1> 
            @endif
        </div>
        </div>
    </div>
    </div>
</div>
</section>
<!-- Signup Form Section -->
<section class="paddings" id="signup-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-7">
                <div class="signup-form shadow-lg border-0 rounded-4 p-4 p-md-5" data-aos="flip-left" data-aos-easing="linear"
                data-aos-duration="1500">
                    <h2 class="mb-4 text-center heading text-uppercase fw-bold text-black fs-40"><span>SCVBA Registration</span></h2>   
                    <form method="POST" action="{{ route('user.register.store') }}" id="subscription-form" enctype="multipart/form-data">
                        @csrf
                        <!-- Hidden Inputs -->
                        {{-- @php
                            // Define the mapping of package_for IDs to role names
                            $roleMapping = [
                                1 => 'Member',
                                2 => 'EPC Developer',
                                // Add more mappings if needed
                            ];

                            // Get the role name based on the package_for ID
                            $roleName = $roleMapping[$package->package_for] ?? 'Unknown';
                        @endphp --}}
                        {{-- <input type="hidden" name="amount" value="{{ $package->price ?? 0 }}">
                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                        <input type="hidden" name="package_description" value="{{ $package->description }}"> --}}
                        {{-- <input type="hidden" name="role" value="{{ $roleName }}"> --}}
                        <div class="row g-3">
                            <!-- First Name -->
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control input-field fs-16 @error('name') is-invalid @enderror" name="name" id="input1" placeholder="First Name" value="{{ old('name') }}" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <!-- Last Name -->
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control input-field fs-16 @error('last_name') is-invalid @enderror" name="last_name" id="input2" placeholder="Last Name" value="{{ old('last_name') }}" required>
                                @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <!-- Phone -->
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control input-field fs-16 @error('phone') is-invalid @enderror" name="phone" id="input4" placeholder="Phone" value="{{ old('phone') }}" required>
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <!-- Email -->
                            <div class="col-12 col-md-6">
                                <input type="email" class="form-control input-field fs-16 @error('email') is-invalid @enderror" name="email" id="input3" placeholder="Email" value="{{ old('email') }}" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <!-- Password -->
                            <div class="col-12 col-md-6">
                                <input type="password" class="form-control input-field fs-16 @error('password') is-invalid @enderror" name="password" id="input5" placeholder="Password" required>
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <!-- Confirm Password -->
                            <div class="col-12 col-md-6">
                                <input type="password" class="form-control input-field fs-16 @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="input6" placeholder="Confirm Password" required>
                                @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div id="category_wrapper" class="col-12 col-md-12" style="display: none;">
                                <select id="category_select" class="form-control input-field fs-16" name="category_id[]" multiple>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <!-- Payment Amount & Stripe -->
                           {{--  @if($package->price != 0)
                            <div class="col-12">
                                <div class="alert alert-info text-center mb-2 rounded-3" style="background:#e3f6fc; color:#1a355e;">
                                    <strong>Package:</strong> {{ $package->title }}<br>
                                    <strong> Payment Amount:</strong> ${{ $package->price }} {{ $package->period }}
                                </div>
                                <div class="mb-3 p-3 border rounded bg-light" id="card-element"></div>
                            </div>
                            @endif --}}
                            <!-- Terms and Conditions -->
                            <div class="col-12 d-flex align-items-center flex-wrap">
                                <input type="checkbox" class="form-check-input me-2" name="terms" id="Check1" required>
                                <label class="form-check-label text-black" for="Check1">
                                    I agree to the <a href="#" class="text-decoration-underline" style="color: #075eff">Terms & Conditions</a> and <a href="#" class="text-decoration-underline" style="color: #075eff">Privacy Policy</a>
                                </label>
                                @error('terms') <div class="invalid-feedback d-block ms-2">{{ $message }}</div> @enderror
                            </div>
                            <!-- Payment Methods Image -->
                           {{--  @if($package->price != 0)
                            <div class="col-12 text-end">
                                <img src="{{ asset('/assets/website/images/stripe_secure.png') }}" alt="Pay-methods" class="img-fluid" style="width:140px;">
                            </div>
                            @endif --}}
                            <!-- Submit Button -->
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-primary mx-auto d-flex justify-content-center text-capitalize w-100" id="register-btn" style="font-size:1.2rem; border-radius:3rem; letter-spacing:1px;">
                                    Register
                                    <span id="register-spinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                                </button>
                            </div>
                        </div>
                        @if($errors->has('error'))
                            <div class="alert alert-danger mt-3">{{ $errors->first('error') }}</div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


{{-- @if($package->price != 0) --}}
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var stripe = Stripe("{{ config('services.stripe.key') }}");
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        var form = document.getElementById('subscription-form');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Always prevent default when using Stripe

            // Show spinner
            document.getElementById('register-btn').disabled = true;
            document.getElementById('register-spinner').classList.remove('d-none');

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    alert(result.error.message);
                    document.getElementById('register-btn').disabled = false;
                    document.getElementById('register-spinner').classList.add('d-none');
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    });
</script>
{{-- @else --}}
<script>
    // If no payment needed, just show spinner on submit
    document.getElementById('subscription-form').addEventListener('submit', function() {
        document.getElementById('register-btn').disabled = true;
        document.getElementById('register-spinner').classList.remove('d-none');
    });
</script>
{{-- @endif --}}

<!-- Choices.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

<!-- Choices.js JS -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const categoryWrapper = document.getElementById('category_wrapper');
    const categorySelect = document.getElementById('category_select');
    const roleInputs = document.querySelectorAll('input[name="role"]');
    let choicesInstance = null;

    function toggleCategoryVisibility() {
        const selectedRole = document.querySelector('input[name="role"]:checked');
        const isContractor = selectedRole && selectedRole.value === 'Contractor';

        if (isContractor) {
            categoryWrapper.style.display = 'block';
            categorySelect.setAttribute('required', 'required');

            if (!choicesInstance) {
                choicesInstance = new Choices(categorySelect, {
                    removeItemButton: true,
                    maxItemCount: 3,
                    searchEnabled: true,
                    placeholderValue: 'Membership Category (Limit 3) *',
                });
            }
        } else {
            categoryWrapper.style.display = 'none';
            categorySelect.removeAttribute('required');

            if (choicesInstance) {
                choicesInstance.destroy();
                choicesInstance = null;
            }
        }
    }

    roleInputs.forEach(input => {
        input.addEventListener('change', toggleCategoryVisibility);
    });

    toggleCategoryVisibility();
});
</script>



