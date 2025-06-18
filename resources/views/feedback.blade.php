<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Conference</title>

    <!-- css -->
    <link rel="stylesheet" href="{{asset('frontend/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/bower_components/ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/main.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

</head>
<body data-spy="scroll" data-target="#site-nav">
<nav id="site-nav" class="navbar navbar-fixed-top navbar-custom">
    <div class="container">
        <div class="navbar-header">

            <!-- logo -->
            <div class="site-branding">
                <a class="logo" href="{{route('home')}}">

                    <!-- logo image  -->
                    {{--                    <img src="{{asset('frontend/assets/images/logo.png')}}" alt="Logo">--}}

                    SPC2025
                </a>
            </div>

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-items" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div><!-- /.navbar-header -->

        <div class="collapse navbar-collapse" id="navbar-items">
            <ul class="nav navbar-nav navbar-right">

                <!-- navigation menu -->
                <li class="active"><a data-scroll href="#about">About</a></li>
                {{--                <li><a data-scroll href="#speakers">Speakers</a></li>--}}
                <li><a data-scroll href="#registration">Book A Seat</a></li>
                <li><a data-scroll href="#partner">Partner</a></li>
                <!-- <li><a data-scroll href="#">Sponsorship</a></li> -->
                <li><a data-scroll href="#faq">FAQ</a></li>
                <li><a  href="{{route('feedback')}}">Feedback</a></li>
                @auth
                    <li><a  href="{{route('dashboard')}}">Dashboard</a></li>

                @else
                    <li><a href="{{route('login')}}">Login</a></li>

                @endauth

            </ul>
        </div>
    </div><!-- /.container -->
</nav>

<header style="background: url('{{ asset('frontend/assets/images/feedback.jpg') }}')" id="site-header" class="site-header valign-center">
    <div class="intro">



{{--        <p id="themeText" class="theme-text">Theme: A Compelling Conviction</p>--}}
<style>
    .theme-text {
        font-size: 1.5rem;
        font-weight: bold;
        color: #fff;
        background: linear-gradient(135deg, rgba(255, 107, 107, 0.3), rgba(68, 68, 68, 0.3));
        padding: 1rem 1.5rem;
        border-radius: 10px;
        text-align: center;
        width: 60%;
        margin: 2rem auto;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        animation: fadeInUp 0.8s ease-out forwards;
        opacity: 0;
        transform: translateY(30px);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .theme-text:hover {
        transform: scale(1.04);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.35);
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 600px) {
        .theme-text {
            font-size: 1.1rem;
            width: 90%;
            padding: 0.8rem 1rem;
        }
    }

</style>



    </div>

</header>





<section id="feedback" class="section bg-light">
    <div class="container">
        <h3 class="text-center mb-4">Detailed Feedback Form</h3>
        <p class="text-center mb-4">Thank you for attending! Your feedback helps us serve you better.</p>
        <form id="feedback-form" method="POST">
            @csrf

            <!-- Personal Info -->
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Full Name *</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>

                <div class="form-group col-md-6">
                    <label>Email Address (optional)</label>
                    <input type="email" name="email" class="form-control">
                </div>
            </div>

            <!-- Rating Questions -->
            <div class="form-group">
                <label>How would you rate the overall experience of the conference? *</label>
                <select name="rating_overall" class="form-control" required>
                    <option value="">-- Select --</option>
                    <option>Excellent</option>
                    <option>Very Good</option>
                    <option>Good</option>
                    <option>Fair</option>
                    <option>Poor</option>
                </select>
            </div>

            <div class="form-group">
                <label>How spiritually impactful was the conference to you personally? *</label>
                <select name="spiritual_impact" class="form-control" required>
                    <option value="">-- Select --</option>
                    <option>Very High</option>
                    <option>High</option>
                    <option>Moderate</option>
                    <option>Low</option>
                    <option>Not Sure</option>
                </select>
            </div>

            <!-- Content / Speaker Rating -->
            <div class="form-group">
                <label>Which session(s) stood out the most to you?</label>
                <textarea name="highlight_sessions" rows="3" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Rate the quality of teachings and messages delivered *</label>
                <select name="content_quality" class="form-control" required>
                    <option value="">-- Select --</option>
                    <option>Exceptional</option>
                    <option>Very Good</option>
                    <option>Good</option>
                    <option>Needs Improvement</option>
                </select>
            </div>

            <div class="form-group">
                <label>Rate the speakers and ministers *</label>
                <select name="speaker_rating" class="form-control" required>
                    <option value="">-- Select --</option>
                    <option>Very Inspiring</option>
                    <option>Good</option>
                    <option>Average</option>
                    <option>Below Average</option>
                </select>
            </div>

            <!-- Logistics / Environment -->
            <div class="form-group">
                <label>How would you rate the event logistics (timing, setup, organization)?</label>
                <select name="logistics" class="form-control">
                    <option value="">-- Select --</option>
                    <option>Excellent</option>
                    <option>Good</option>
                    <option>Average</option>
                    <option>Poor</option>
                </select>
            </div>

            <div class="form-group">
                <label>Venue and Environment</label>
                <select name="venue_rating" class="form-control">
                    <option value="">-- Select --</option>
                    <option>Perfect</option>
                    <option>Comfortable</option>
                    <option>Needs Improvement</option>
                </select>
            </div>

            <!-- Follow Up -->
            <div class="form-group">
                <label>Would you like to attend future conferences by LST/MIV Rhema House Ministry?</label>
                <select name="attend_again" class="form-control" required>
                    <option value="">-- Select --</option>
                    <option>Yes, definitely</option>
                    <option>Maybe</option>
                    <option>No</option>
                </select>
            </div>

            <!-- Suggestions -->
            <div class="form-group">
                <label>What should we improve on?</label>
                <textarea name="improvements" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label>Other comments or testimonies?</label>
                <textarea name="testimonies" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Feedback</button>
        </form>
    </div>
</section>






<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="site-info"> Developed by <a href="https://spc.mivrhemahouse.org.ng/">MIVRhemaHouse Media</a></p>
                <ul class="social-block">
                    <li><a href=""><i class="ion-social-twitter"></i></a></li>
                    <li><a href=""><i class="ion-social-facebook"></i></a></li>
                    <li><a href=""><i class="ion-social-linkedin-outline"></i></a></li>
                    <li><a href=""><i class="ion-social-googleplus"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- script -->
<script src="{{asset('frontend/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('frontend/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/bower_components/smooth-scroll/dist/js/smooth-scroll.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/main.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $('#feedback-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('feedback.submit') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(res) {
                toastr.success(res.message);
                $('#feedback-form')[0].reset();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    Object.values(errors).forEach(msgArr => toastr.error(msgArr[0]));
                } else if (xhr.status === 409) {
                    toastr.warning(xhr.responseJSON.message);
                } else {
                    toastr.error("Something went wrong.");
                }
            }

        });
    });

</script>

</body>
</html>
