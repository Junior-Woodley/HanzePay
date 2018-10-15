<?php include('partials/header.php') ?>

    <body>

    <div class="container card p-5 mt-3 mb-3">
    <section class="team-section text-center">
        <h2 class="h1-responsive font-weight-bold">Het HanzePay Team</h2>
        <p class="grey-text w-responsive mx-auto mb-5">HanzePay is mogelijk gemaakt door de volgende studenten van de Hanze Hogeschool.</p>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-lg-0 mb-5">
                <div class="avatar mx-auto">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(20).jpg" class="rounded-circle z-depth-1" alt="Sample avatar">
                </div>
                <h5 class="font-weight-bold mt-4 mb-3">Joey Kheireddine</h5>
                <p class="text-uppercase blue-text"><strong>Graphic designer</strong></p>
                <p class="grey-text">Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci  sed quia non numquam modi tempora eius.</p>
                <ul class="list-unstyled mb-0">
                    <a class="p-2 fa-lg fb-ic">
                        <i class="fa fa-facebook blue-text"> </i>
                    </a>
                    <a class="p-2 fa-lg tw-ic">
                        <i class="fa fa-twitter blue-text"> </i>
                    </a>
                    <a class="p-2 fa-lg ins-ic">
                        <i class="fa fa-instagram blue-text"> </i>
                    </a>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-lg-0 mb-5">
                <div class="avatar mx-auto">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(3).jpg" class="rounded-circle z-depth-1" alt="Sample avatar">
                </div>
                <h5 class="font-weight-bold mt-4 mb-3">Timo de Jong</h5>
                <p class="text-uppercase blue-text"><strong>Web developer</strong></p>
                <p class="grey-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem ipsa accusantium doloremque rem laudantium totam aperiam.</p>
                <ul class="list-unstyled mb-0">
                    <a class="p-2 fa-lg fb-ic">
                        <i class="fa fa-facebook blue-text"> </i>
                    </a>
                    <a class="p-2 fa-lg ins-ic">
                        <i class="fa fa-instagram blue-text"> </i>
                    </a>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-md-0 mb-5">
                <div class="avatar mx-auto">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(30).jpg" class="rounded-circle z-depth-1" alt="Sample avatar">
                </div>
                <h5 class="font-weight-bold mt-4 mb-3">Maria Smith</h5>
                <p class="text-uppercase blue-text"><strong>Photographer</strong></p>
                <p class="grey-text">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim est fugiat nulla id eu laborum.</p>
                <ul class="list-unstyled mb-0">
                    <a class="p-2 fa-lg fb-ic">
                        <i class="fa fa-facebook blue-text"> </i>
                    </a>
                    <a class="p-2 fa-lg ins-ic">
                        <i class="fa fa-instagram blue-text"> </i>
                    </a>
                    <a class="p-2 fa-lg ins-ic">
                        <i class="fa fa-dribbble blue-text"> </i>
                    </a>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="avatar mx-auto">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(32).jpg" class="rounded-circle z-depth-1" alt="Sample avatar">
                </div>
                <h5 class="font-weight-bold mt-4 mb-3">Tom Adams</h5>
                <p class="text-uppercase blue-text"><strong>Backend developer</strong></p>
                <p class="grey-text">Perspiciatis repellendus ad odit consequuntur, eveniet earum nisi qui consectetur totam officia voluptates perferendis voluptatibus aut.</p>
                <ul class="list-unstyled mb-0">
                    <a class="p-2 fa-lg fb-ic">
                        <i class="fa fa-facebook blue-text"> </i>
                    </a>
                    <a class="p-2 fa-lg ins-ic">
                        <i class="fa fa-github blue-text"> </i>
                    </a>
                </ul>
            </div>
        </div>
    </section>

        <hr>

      z<section class="section">
            <h2 class="h1-responsive font-weight-bold text-center">Contact us</h2>
            <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
                matter of hours to help you.</p>
            <div class="row">
                <div class="col-md-9 mb-md-0 mb-5">
                    <form id="contact-form" name="contact-form" action="mail.php" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <input type="text" id="name" name="name" class="form-control">
                                    <label for="name" class="">Your name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <input type="text" id="email" name="email" class="form-control">
                                    <label for="email" class="">Your email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-0">
                                    <input type="text" id="subject" name="subject" class="form-control">
                                    <label for="subject" class="">Subject</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form">
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                    <label for="message">Your message</label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="text-center text-md-left">
                        <a class="btn btn-hanze" onclick="document.getElementById('contact-form').submit();">Send</a>
                    </div>
                    <div class="status"></div>
                </div>
                <div class="col-md-3 text-center">
                    <ul class="list-unstyled mb-0">
                        <li><i class="fa fa-map-marker fa-2x"></i>
                            <p>San Francisco, CA 94126, USA</p>
                        </li>

                        <li><i class="fa fa-phone mt-4 fa-2x"></i>
                            <p>+ 01 234 567 89</p>
                        </li>

                        <li><i class="fa fa-envelope mt-4 fa-2x"></i>
                            <p>contact@mdbootstrap.com</p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
    </body>

<?php include('partials/footer.php');