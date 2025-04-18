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
{{--                <li><a data-scroll href="#schedule">Schedule</a></li>--}}
                <li><a data-scroll href="#partner">Partner</a></li>
                <!-- <li><a data-scroll href="#">Sponsorship</a></li> -->
                <li><a data-scroll href="#faq">FAQ</a></li>
{{--                <li><a data-scroll href="#photos">Photos</a></li>--}}

            </ul>
        </div>
    </div><!-- /.container -->
</nav>

<header id="site-header" class="site-header valign-center">
    <div class="intro">

        <h2>June 6–9, 2025 / MIV Rhema House</h2>

        <h1>Sexual Purity Conference 2025</h1>

        <p>Walking in Truth, Living with Purpose</p>

        <a class="btn btn-white" data-scroll href="#registration">Register Now</a>

    </div>

</header>

<section id="about" class="section about">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">

                <h3 class="section-title">About Us</h3>

                <p>
                    The Sexual Purity Conference 2025 is a life-transforming event organized by MIV Rhema House, dedicated to equipping individuals—young and old—with biblical truths and practical wisdom to walk in purity in a world that often celebrates compromise. This gathering is more than a conference; it's a movement of hearts returning to God’s design for love, honor, and holiness.
                </p>

                <figure>
                    <img alt="About Sexual Purity Conference" class="img-responsive" src="{{ asset('frontend/assets/images/about-us.jpg') }}">
                </figure>

            </div><!-- /.col-sm-6 -->

            <div class="col-sm-6">

                <h3 class="section-title multiple-title">What is Our Goal?</h3>

                <p>
                    Our mission is to raise a generation that values sexual integrity, godly relationships, and a lifestyle that glorifies God in both body and spirit. Through worship, teachings, panel discussions, and peer support, we aim to challenge the norms and ignite a passion for purity.
                </p>

                <ul class="list-arrow-right">
                    <li>Gain biblical understanding on purity, identity, and purpose</li>
                    <li>Hear life-changing testimonies and teachings from seasoned ministers</li>
                    <li>Build godly relationships and accountability circles</li>
                    <li>Empower young hearts to honor God in a culture of compromise</li>
                </ul>

            </div><!-- /.col-sm-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>

<section id="facts" class="section bg-image-1 facts text-center">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <i class="ion-ios-calendar"></i>
                <h3>2025<br>June 6–9</h3>
            </div>
            <div class="col-sm-3">
                <i class="ion-ios-location"></i>
                <h3>MIV Rhema House<br>Nigeria</h3>
            </div>
            <div class="col-sm-3">
                <i class="ion-pricetags"></i>
                <h3>500+<br>Seats Available</h3>
            </div>
            <div class="col-sm-3">
                <i class="ion-speakerphone"></i>
                <h3>10+<br>Inspired Speakers</h3>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</section>


<section id="registration" class="section registration">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-title">🌸 Sexual Purity Conference 2025 – Registration Form 🌸</h3>
                <p><strong>🕒 Arrival Time:</strong> 4:00pm on Friday</p>
                <p>Please fill out the form below to reserve your spot. Admission is free, but registration is required. We look forward to seeing you there!</p>
            </div>
        </div>

        <form id="registration-form">
            <!-- Section 1: Personal Information -->
            <div class="row">
                <div class="col-md-12">
                    <h4>Section 1: Personal Information</h4>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Full Name" id="fullname" name="fullname" required>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" name="gender" id="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="prefer-not-to-say">Prefer not to say</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="tel" class="form-control" placeholder="Phone Number" id="phone" name="phone" required>
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email Address" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Location (City/State)" id="location" name="location">
                    </div>
                </div>

                <!-- Section 2: Participation Details -->
                <div class="col-sm-6">
                    <h4>Section 2: Participation Details</h4>

                    <div class="form-group">
                        <label for="how-heard">How did you hear about the Sexual Purity Conference?</label>
                        <select class="form-control" name="how_heard" id="how-heard" required>
                            <option value="">Select an option</option>
                            <option value="church-announcement">Church Announcement</option>
                            <option value="social-media">Social Media</option>
                            <option value="friend-family">Friend/Family</option>
                            <option value="whatsapp-group">WhatsApp Group</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Have you attended any of our previous conferences or programs?</label>
                        <select class="form-control" name="previous_participation" id="previous_participation" required>
                            <option value="">Select an option</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Are you registering as an individual or on behalf of a group?</label>
                        <select class="form-control" name="registration_type" id="registration_type" required>
                            <option value="">Select an option</option>
                            <option value="individual">Individual</option>
                            <option value="group">Group</option>
                        </select>
                    </div>

                    <div class="form-group" id="group-details" style="display:none;">
                        <label>If "Group", please state your group name and number of participants:</label>
                        <input type="text" class="form-control" name="group_name" placeholder="Group Name">
                        <input type="number" class="form-control" name="group_size" placeholder="Number of Participants">
                    </div>
                </div>
            </div>

            <!-- Section 3: Expectations and Commitments -->
            <div class="row">
                <div class="col-md-12">
                    <h4>Section 3: Expectations and Commitments</h4>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="expectations">What are your expectations for this conference?</label>
                        <textarea class="form-control" name="expectations" id="expectations" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Do you commit to attend all sessions of the conference?</label>
                        <select class="form-control" name="commitment" id="commitment" required>
                            <option value="">Select an option</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Would you like to receive updates and resources on sexual purity after the conference?</label>
                        <select class="form-control" name="receive_updates" id="receive_updates" required>
                            <option value="">Select an option</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="text-center mt20">
                <button type="submit" class="btn btn-black" id="registration-submit-btn">Submit</button>
            </div>
        </form>

        <div id="registration-msg" style="display:none;">
            <div class="alert alert-success">
                ✅ Thank you for registering! You will receive a confirmation email and additional event details shortly. Please follow our social media pages for updates.
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('registration_type').addEventListener('change', function() {
        var groupDetails = document.getElementById('group-details');
        if (this.value === 'group') {
            groupDetails.style.display = 'block';
        } else {
            groupDetails.style.display = 'none';
        }
    });

</script>


<section id="partner" class="section partner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-title">Event Partner</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <a class="partner-box partner-box-1"></a>
            </div>
            <div class="col-sm-3">
                <a class="partner-box partner-box-2"></a>
            </div>
            <div class="col-sm-3">
                <a class="partner-box partner-box-3"></a>
            </div>
            <div class="col-sm-3">
                <a class="partner-box partner-box-4"></a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <a class="partner-box partner-box-5"></a>
            </div>
            <div class="col-sm-3">
                <a class="partner-box partner-box-6"></a>
            </div>
            <div class="col-sm-3">
                <a class="partner-box partner-box-7"></a>
            </div>
            <div class="col-sm-3">
                <a class="partner-box partner-box-8"></a>
            </div>
        </div>
</section>

<section id="faq" class="section faq">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="section-title">Event FAQs</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> What is the price of the ticket?</a>
                            </h4>
                        </div>

                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <p>The ticket for the Sexual Purity Conference 2025 is absolutely free! However, we do require registration in advance to secure your spot at the event. We look forward to having you with us!</p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> What is included in my ticket?</a>
                            </h4>
                        </div>

                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <p>Your ticket grants you access to all conference sessions, including keynote speeches, panel discussions, and interactive workshops. You’ll also receive complimentary refreshments and have the opportunity to network with like-minded individuals.</p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> What is the office address?</a>
                            </h4>
                        </div>

                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
                                <p>The Sexual Purity Conference is being held at the following address: <strong>123 Conference Center Avenue, Cityville, State, ZIP.</strong> We look forward to welcoming you to this inspiring location!</p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFour">
                            <h4 class="panel-title">
                                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> How should I dress?</a>
                            </h4>
                        </div>

                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                            <div class="panel-body">
                                <p>We encourage smart casual attire for the conference. Please dress comfortably as you may participate in interactive sessions and workshops. If you plan to attend the evening social event, feel free to dress more casually for that part of the day.</p>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFive">
                            <h4 class="panel-title">
                                <a class="faq-toggle collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive"> I have specific questions that are not addressed here. Who can help me?</a>
                            </h4>
                        </div>

                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                            <div class="panel-body">
                                <p>If you have any further questions, feel free to contact our event support team at <strong>support@sexualpurityconference.com</strong>. We’ll be happy to assist you with any inquiries you have regarding the event or registration process.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
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
</body>
</html>
