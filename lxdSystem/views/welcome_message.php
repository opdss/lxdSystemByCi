<!-- main container -->
<div class="content">

    <!-- settings changer -->
    <div class="skins-nav">
        <a href="#" class="skin first_nav selected">
            <span class="icon"></span><span class="text">Default</span>
        </a>
        <a href="#" class="skin second_nav" data-file="css/compiled/skins/dark.css">
            <span class="icon"></span><span class="text">Dark skin</span>
        </a>
    </div>

    <div id="pad-wrapper" class="gallery">
        <div class="row header">
            <div class="col-md-12">
                <h3>Gallery</h3>
            </div>
        </div>

        <!-- gallery wrapper -->
        <div class="gallery-wrapper">
            <div class="row gallery-row">
                <!-- single image -->
                <div class="col-md-3 img-container">
                    <div class="img-box">
                            <span class="icon edit">
                                <a data-toggle="modal" href="#myModal"><i class="gallery-edit"></i></a>
                            </span>
                            <span class="icon trash">
                                <i class="gallery-trash"></i>
                            </span>
                        <img src="img/gallery3.jpg" class="img-responsive" />
                        <p class="title">
                            Beach pic title
                        </p>
                    </div>
                </div>
                <!-- single image -->
                <div class="col-md-3 img-container">
                    <div class="img-box">
                            <span class="icon edit">
                                <a data-toggle="modal" href="#myModal"><i class="gallery-edit"></i></a>
                            </span>
                            <span class="icon trash">
                                <i class="gallery-trash"></i>
                            </span>
                        <img src="img/gallery2.jpg" class="img-responsive" />
                        <p class="title">
                            Beach pic title 2
                        </p>
                    </div>
                </div>
                <!-- single image -->
                <div class="col-md-3 img-container">
                    <div class="img-box">
                            <span class="icon edit">
                                <a data-toggle="modal" href="#myModal"><i class="gallery-edit"></i></a>
                            </span>
                            <span class="icon trash">
                                <i class="gallery-trash"></i>
                            </span>
                        <img src="img/gallery1.jpg" class="img-responsive" />
                        <p class="title">
                            Beach pic title 3
                        </p>
                    </div>
                </div>
                <!-- single image -->
                <div class="col-md-3 img-container">
                    <div class="img-box">
                            <span class="icon edit">
                                <a data-toggle="modal" href="#myModal"><i class="gallery-edit"></i></a>
                            </span>
                            <span class="icon trash">
                                <i class="gallery-trash"></i>
                            </span>
                        <img src="img/gallery3.jpg" class="img-responsive" />
                        <p class="title">
                            Beach pic title
                        </p>
                    </div>
                </div>
            </div>
            <div class="row gallery-row">
                <!-- single image -->
                <div class="col-md-3 img-container">
                    <div class="img-box">
                            <span class="icon edit">
                                <a data-toggle="modal" href="#myModal"><i class="gallery-edit"></i></a>
                            </span>
                            <span class="icon trash">
                                <i class="gallery-trash"></i>
                            </span>
                        <img src="img/gallery2.jpg" class="img-responsive" />
                        <p class="title">
                            Beach pic title 2
                        </p>
                    </div>
                </div>
                <!-- single image -->
                <div class="col-md-3 img-container">
                    <div class="img-box">
                            <span class="icon edit">
                                <a data-toggle="modal" href="#myModal"><i class="gallery-edit"></i></a>
                            </span>
                            <span class="icon trash">
                                <i class="gallery-trash"></i>
                            </span>
                        <img src="img/gallery1.jpg" class="img-responsive" />
                        <p class="title">
                            Beach pic title 3
                        </p>
                    </div>
                </div>

                <!-- new image button -->
                <div class="col-md-3 new-img">
                    <a data-toggle="modal" href="#myModal">
                        <img src="img/new-gallery-img.png" class="img-responsive" />
                    </a>
                </div>
            </div>
        </div>
        <!-- end gallery wrapper -->

        <!-- blank state -->
        <div class="no-gallery">
            <div class="row header">
                <div class="col-md-12">
                    <h3>Gallery Blank State</h3>
                </div>
            </div>
            <div class="center">
                <img src="img/no-img-gallery.png">
                <h6>You don't have any images</h6>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                <a data-toggle="modal" href="#myModal" class="btn-glow primary">Add new image</a>
            </div>
        </div>
        <!-- end blank state -->
    </div>
</div>