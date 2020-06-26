


@extends('layout')

@section('css')

@endsection
@section('breadcrumb')
<!-- Content Header (Page header) -->
<ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="demo-pli-home"></i> </a></li>
    <li class="">Configuracion</li>
    <li class="active">Importación</li>
</ol>

@endsection

@section('content')

<div id="container" class="effect aside-float aside-bright mainnav-lg">
                <div id="page-content">

					<div class="panel">
					    <div class="eq-height clearfix">
					        <div class="col-md-4 eq-box-md text-center box-vmiddle-wrap bord-hor">

					            <!-- Simple Promotion Widget -->
					            <!--===================================================-->
					            <div class="box-vmiddle pad-all">
					                <h3 class="text-main">Register Today</h3>
					                <div class="pad-ver">
					                    <i class="demo-pli-bag-coins icon-5x"></i>
					                </div>
					                <p class="pad-btn text-sm">Members get <span class="text-lg text-bold text-main">50%</span> more points, so register today and start earning points for savings on great rewards!</p>
					                <br>
					                <a class="btn btn-lg btn-primary" href="#">Learn More...</a>
					            </div>
					            <!--===================================================-->

					        </div>
					        <div class="col-md-8 eq-box-md eq-no-panel">

					            <!-- Main Form Wizard -->
					            <!--===================================================-->
					            <div id="demo-main-wz">

					                <!--nav-->
					                <ul class="row wz-step wz-icon-bw wz-nav-off mar-top">
					                    <li class="col-xs-3">
					                        <a data-toggle="tab" href="#demo-main-tab1">
					                            <span class="text-danger"><i class="demo-pli-information icon-2x"></i></span>
					                            <h5 class="mar-no">Account</h5>
					                        </a>
					                    </li>
					                    <li class="col-xs-3">
					                        <a data-toggle="tab" href="#demo-main-tab2">
					                            <span class="text-warning"><i class="demo-pli-male icon-2x"></i></span>
					                            <h5 class="mar-no">Profile</h5>
					                        </a>
					                    </li>
					                    <li class="col-xs-3">
					                        <a data-toggle="tab" href="#demo-main-tab3">
					                            <span class="text-info"><i class="demo-pli-home icon-2x"></i></span>
					                            <h5 class="mar-no">Address</h5>
					                        </a>
					                    </li>
					                    <li class="col-xs-3">
					                        <a data-toggle="tab" href="#demo-main-tab4">
					                            <span class="text-success"><i class="demo-pli-medal-2 icon-2x"></i></span>
					                            <h5 class="mar-no">Finish</h5>
					                        </a>
					                    </li>
					                </ul>

					                <!--progress bar-->
					                <div class="progress progress-xs">
					                    <div class="progress-bar progress-bar-primary"></div>
					                </div>


					                <!--form-->
					                <form class="form-horizontal">
					                    <div class="panel-body">
					                        <div class="tab-content">

					                            <!--First tab-->
					                            <div id="demo-main-tab1" class="tab-pane">
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Username</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" class="form-control" name="username" placeholder="Username">
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Email address</label>
					                                    <div class="col-lg-9">
					                                        <input type="email" class="form-control" name="email" placeholder="Email">
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Password</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-4">
					                                                <input type="password" class="form-control mar-btm" name="password" placeholder="Password">
					                                            </div>
					                                            <div class="col-lg-4 text-lg-right"><label class="control-label">Retype password</label></div>
					                                            <div class="col-lg-4"><input type="password" class="form-control" name="password2" placeholder="Retype password"></div>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>

					                            <!--Second tab-->
					                            <div id="demo-main-tab2" class="tab-pane fade">
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">First name</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-4">
					                                                <input type="text" placeholder="First name" name="firstName" class="form-control">
					                                            </div>
					                                            <div class="col-lg-4 text-lg-right"><label class="control-label">Last name</label></div>
					                                            <div class="col-lg-4"><input type="text" placeholder="Last name" name="lastName" class="form-control"></div>
					                                        </div>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Company</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Company" name="company" class="form-control">
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Member Type</label>
					                                    <div class="col-lg-9">
					                                        <div class="radio">
					                                            <input id="demo-radio-1" class="magic-radio" type="radio" name="memberType" value="free">
					                                            <label for="demo-radio-1">Free</label>

					                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="memberType" value="personal">
					                                            <label for="demo-radio-2">Personal</label>

					                                            <input id="demo-radio-3" class="magic-radio" type="radio" name="memberType" value="bussines">
					                                            <label for="demo-radio-3">Bussiness</label>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>

					                            <!--Third tab-->
					                            <div id="demo-main-tab3" class="tab-pane">
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Phone Number</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Phone number" name="phoneNumber" class="form-control">
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Address</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Address" name="address" class="form-control">
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">City</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="City" name="city" class="form-control">
					                                            </div>
					                                            <div class="col-lg-3 text-lg-right"><label class="control-label">Poscode</label></div>
					                                            <div class="col-lg-4"><input type="text" placeholder="Poscode" name="poscode" class="form-control"></div>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>

					                            <!--Fourth tab-->
					                            <div id="demo-main-tab4" class="tab-pane">
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Bio</label>
					                                    <div class="col-lg-9">
					                                        <textarea placeholder="Tell us your story..." rows="4" name="bio" class="form-control"></textarea>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <div class="col-lg-9 col-lg-offset-2">
					                                        <div class="checkbox">
					                                            <input id="demo-checkbox-1" class="magic-checkbox" type="checkbox" name="acceptTerms">
					                                            <label for="demo-checkbox-1"> Accept the terms and policies</label>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </div>


					                    <!--Footer buttons-->
					                    <div class="pull-right pad-rgt mar-btm">
					                        <button type="button" class="previous btn btn-primary">Previous</button>
					                        <button type="button" class="next btn btn-primary">Next</button>
					                        <button type="button" class="finish btn btn-success" disabled>Finish</button>
					                    </div>

					                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
@endsection





