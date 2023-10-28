@extends('template.index')

@section('styles')
    <link href="{{ asset('template/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('template/assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/plugins/noUiSlider/nouislider.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/plugins/noUiSlider/custom-nouiSlider.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/plugins/bootstrap-range-Slider/bootstrap-slider.css') }}" rel="stylesheet"
        type="text/css">
@endsection

@section('content')
    @can('admin.home')
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="row widget-statistic">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="widget widget-one_hybrid widget-followers">
                        <div class="widget-heading">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>

                            <p class="w-value">{{ $usuariosModelos }} Usuarios</p>
                            <p class="w-value">5%</p>
                        </div>
                        <div class="widget-content">
                            <div class="w-chart">
                                <div id="hybrid_followers"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="widget widget-one_hybrid widget-referral">
                        <div class="widget-heading">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-link">
                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                </svg>
                            </div>
                            <p class="w-value">{{ $multas }}</p>
                            <h5 class="">Multas</h5>
                        </div>
                        <div class="widget-content">
                            <div class="w-chart">
                                <div id="hybrid_followers1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="widget widget-one_hybrid widget-engagement">
                        <div class="widget-heading">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-message-circle">
                                    <path
                                        d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                    </path>
                                </svg>
                            </div>
                            <p class="w-value">18.2%</p>
                            <h5 class="">Descuentos</h5>
                        </div>
                        <div class="widget-content">
                            <div class="w-chart">
                                <div id="hybrid_followers3"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="widget widget-card-four" style="height: 22.29rem;">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <h6 class="value">$ 45,141</h6>
                                    <p class="">Meta</p>
                                </div>
                                <div class="">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 57%"
                                    aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row layout-top-spacing">
                <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget-four">
                        <div class="widget-heading">
                            <h5 class="">Visitors by Browser</h5>
                        </div>
                        <div class="widget-content">
                            <div class="vistorsBrowser">
                                <div class="browser-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <circle cx="12" cy="12" r="4"></circle>
                                            <line x1="21.17" y1="8" x2="12" y2="8"></line>
                                            <line x1="3.95" y1="6.06" x2="8.54" y2="14"></line>
                                            <line x1="10.88" y1="21.94" x2="15.46" y2="14"></line>
                                        </svg>
                                    </div>
                                    <div class="w-browser-details">
                                        <div class="w-browser-info">
                                            <h6>Chrome</h6>
                                            <p class="browser-count">65%</p>
                                        </div>
                                        <div class="w-browser-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-primary" role="progressbar"
                                                    style="width: 65%" aria-valuenow="90" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="browser-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                                        </svg>
                                    </div>
                                    <div class="w-browser-details">

                                        <div class="w-browser-info">
                                            <h6>Safari</h6>
                                            <p class="browser-count">25%</p>
                                        </div>

                                        <div class="w-browser-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-danger" role="progressbar"
                                                    style="width: 35%" aria-valuenow="65" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="browser-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="2" y1="12" x2="22" y2="12"></line>
                                            <path
                                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="w-browser-details">

                                        <div class="w-browser-info">
                                            <h6>Others</h6>
                                            <p class="browser-count">15%</p>
                                        </div>

                                        <div class="w-browser-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-warning" role="progressbar"
                                                    style="width: 15%" aria-valuenow="15" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                    <div class="widget-three">
                        <div class="widget-heading">
                            <h5 class="">Summary</h5>
                        </div>
                        <div class="widget-content">

                            <div class="order-summary">

                                <div class="summary-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-shopping-bag">
                                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                            <line x1="3" y1="6" x2="21" y2="6"></line>
                                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                                        </svg>
                                    </div>
                                    <div class="w-summary-details">

                                        <div class="w-summary-info">
                                            <h6>Income</h6>
                                            <p class="summary-count">$92,600</p>
                                        </div>

                                        <div class="w-summary-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-secondary" role="progressbar"
                                                    style="width: 90%" aria-valuenow="90" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="summary-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag">
                                            <path
                                                d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                                            </path>
                                            <line x1="7" y1="7" x2="7" y2="7"></line>
                                        </svg>
                                    </div>
                                    <div class="w-summary-details">

                                        <div class="w-summary-info">
                                            <h6>Profit</h6>
                                            <p class="summary-count">$37,515</p>
                                        </div>

                                        <div class="w-summary-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-success" role="progressbar"
                                                    style="width: 65%" aria-valuenow="65" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="summary-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-credit-card">
                                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2">
                                            </rect>
                                            <line x1="1" y1="10" x2="23" y2="10"></line>
                                        </svg>
                                    </div>
                                    <div class="w-summary-details">

                                        <div class="w-summary-info">
                                            <h6>Expenses</h6>
                                            <p class="summary-count">$55,085</p>
                                        </div>

                                        <div class="w-summary-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-warning" role="progressbar"
                                                    style="width: 80%" aria-valuenow="80" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-table-three">

                        <div class="widget-heading">
                            <h5 class="">Top Selling Product</h5>
                        </div>

                        <div class="widget-content">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="th-content">Product</div>
                                            </th>
                                            <th>
                                                <div class="th-content th-heading">Price</div>
                                            </th>
                                            <th>
                                                <div class="th-content th-heading">Discount</div>
                                            </th>
                                            <th>
                                                <div class="th-content">Sold</div>
                                            </th>
                                            <th>
                                                <div class="th-content">Source</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="td-content product-name"><img src="assets/img/90x90.jpg"
                                                        alt="product">Speakers</div>
                                            </td>
                                            <td>
                                                <div class="td-content"><span class="pricing">$84.00</span></div>
                                            </td>
                                            <td>
                                                <div class="td-content"><span class="discount-pricing">$10.00</span></div>
                                            </td>
                                            <td>
                                                <div class="td-content">240</div>
                                            </td>
                                            <td>
                                                <div class="td-content"><a href="javascript:void(0);"
                                                        class="">Direct</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="td-content product-name"><img src="assets/img/90x90.jpg"
                                                        alt="product">Sunglasses</div>
                                            </td>
                                            <td>
                                                <div class="td-content"><span class="pricing">$56.07</span></div>
                                            </td>
                                            <td>
                                                <div class="td-content"><span class="discount-pricing">$5.07</span></div>
                                            </td>
                                            <td>
                                                <div class="td-content">190</div>
                                            </td>
                                            <td>
                                                <div class="td-content"><a href="javascript:void(0);"
                                                        class="">Google</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="td-content product-name"><img src="assets/img/90x90.jpg"
                                                        alt="product">Watch</div>
                                            </td>
                                            <td>
                                                <div class="td-content"><span class="pricing">$88.00</span></div>
                                            </td>
                                            <td>
                                                <div class="td-content"><span class="discount-pricing">$20.00</span></div>
                                            </td>
                                            <td>
                                                <div class="td-content">66</div>
                                            </td>
                                            <td>
                                                <div class="td-content"><a href="javascript:void(0);" class="">Ads</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="td-content product-name"><img src="assets/img/90x90.jpg"
                                                        alt="product">Laptop</div>
                                            </td>
                                            <td>
                                                <div class="td-content"><span class="pricing">$110.00</span></div>
                                            </td>
                                            <td>
                                                <div class="td-content"><span class="discount-pricing">$33.00</span></div>
                                            </td>
                                            <td>
                                                <div class="td-content">35</div>
                                            </td>
                                            <td>
                                                <div class="td-content"><a href="javascript:void(0);"
                                                        class="">Email</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="td-content product-name"><img src="assets/img/90x90.jpg"
                                                        alt="product">Camera</div>
                                            </td>
                                            <td>
                                                <div class="td-content"><span class="pricing">$126.04</span></div>
                                            </td>
                                            <td>
                                                <div class="td-content"><span class="discount-pricing">$26.04</span></div>
                                            </td>
                                            <td>
                                                <div class="td-content">30</div>
                                            </td>
                                            <td>
                                                <div class="td-content"><a href="javascript:void(0);"
                                                        class="">Referral</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="td-content product-name"><img src="assets/img/90x90.jpg"
                                                        alt="product">Shoes</div>
                                            </td>
                                            <td>
                                                <div class="td-content"><span class="pricing">$108.09</span></div>
                                            </td>
                                            <td>
                                                <div class="td-content"><span class="discount-pricing">$47.09</span></div>
                                            </td>
                                            <td>
                                                <div class="td-content">130</div>
                                            </td>
                                            <td>
                                                <div class="td-content"><a href="javascript:void(0);"
                                                        class="">Google</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="td-content product-name"><img src="assets/img/90x90.jpg"
                                                        alt="product">Headphone</div>
                                            </td>
                                            <td>
                                                <div class="td-content"><span class="pricing">$168.09</span></div>
                                            </td>
                                            <td>
                                                <div class="td-content"><span class="discount-pricing">$60.09</span></div>
                                            </td>
                                            <td>
                                                <div class="td-content">170</div>
                                            </td>
                                            <td>
                                                <div class="td-content"><a href="javascript:void(0);" class="">Ads</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="mb-4">Using HTML5 input elements</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area align-center">
                            <div class="container">
                                <div id="html5"></div>
                                <br />
                                <div class="row mt-4 mb-4">
                                    <div class="col-lg-6 mb-3">
                                        <select id="input-select" class="form-control"></select>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" min="-20" max="40"
                                            step="1" id="input-number">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="chartLine" class="col-xl-9 layout-top-spacing layout-spacing">
                    <div class="widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Apex (Simple)</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div id="s-line" class=""></div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-3 col-lg-12 col-md-6 col-sm-12 col-12 layout-top-spacing">
                    <div class="widget widget-table-one" style="padding-top: 2rem; height: 31.0rem;">
                        <div class="widget-heading">
                            <h5 class="">Transactions</h5>
                        </div>

                        <div class="widget-content">
                            <div class="transactions-list">
                                <div class="t-item">
                                    <div class="t-company-name">
                                        <div class="t-icon">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-home">
                                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="t-name">
                                            <h4>Electricity Bill</h4>
                                            <p class="meta-date">4 Aug 1:00PM</p>
                                        </div>

                                    </div>
                                    <div class="t-rate rate-dec">
                                        <p><span>-$16.44</span> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-arrow-down">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <polyline points="19 12 12 19 5 12"></polyline>
                                            </svg></p>
                                    </div>
                                </div>
                            </div>

                            <div class="transactions-list">
                                <div class="t-item">
                                    <div class="t-company-name">
                                        <div class="t-icon">
                                            <div class="avatar avatar-xl">
                                                <span class="avatar-title rounded-circle">SP</span>
                                            </div>
                                        </div>
                                        <div class="t-name">
                                            <h4>Shaun Park</h4>
                                            <p class="meta-date">4 Aug 1:00PM</p>
                                        </div>
                                    </div>
                                    <div class="t-rate rate-inc">
                                        <p><span>+$66.44</span> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-arrow-up">
                                                <line x1="12" y1="19" x2="12" y2="5"></line>
                                                <polyline points="5 12 12 5 19 12"></polyline>
                                            </svg></p>
                                    </div>
                                </div>
                            </div>

                            <div class="transactions-list">
                                <div class="t-item">
                                    <div class="t-company-name">
                                        <div class="t-icon">
                                            <div class="avatar avatar-xl">
                                                <span class="avatar-title rounded-circle">AD</span>
                                            </div>
                                        </div>
                                        <div class="t-name">
                                            <h4>Amy Diaz</h4>
                                            <p class="meta-date">4 Aug 1:00PM</p>
                                        </div>

                                    </div>
                                    <div class="t-rate rate-inc">
                                        <p><span>+$66.44</span> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-arrow-up">
                                                <line x1="12" y1="19" x2="12" y2="5"></line>
                                                <polyline points="5 12 12 5 19 12"></polyline>
                                            </svg></p>
                                    </div>
                                </div>
                            </div>

                            <div class="transactions-list">
                                <div class="t-item">
                                    <div class="t-company-name">
                                        <div class="t-icon">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-home">
                                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="t-name">
                                            <h4>Netflix</h4>
                                            <p class="meta-date">4 Aug 1:00PM</p>
                                        </div>

                                    </div>
                                    <div class="t-rate rate-dec">
                                        <p><span>-$32.00</span> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-arrow-down">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <polyline points="19 12 12 19 5 12"></polyline>
                                            </svg></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div id="chartColumn" class="col-xl-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Simple Column</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div id="s-col" class=""></div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    @endsection

    @section('js')
        <script src="{{ asset('template/plugins/apex/apexcharts.min.js') }}"></script>
        <script src="{{ asset('template/assets/js/dashboard/dash_1.js') }}"></script>
        <script src="{{ asset('template/assets/js/dashboard/dash_2.js') }}"></script>


        {{-- Using HTML5 input elements --}}
        <script>
            var html5Slider = document.getElementById('html5');

            noUiSlider.create(html5Slider, {
                start: [10, 30],
                connect: true,
                tooltips: true,
                range: {
                    'min': -20,
                    'max': 40
                }
            });
        </script>
        {{-- Apex (Simple) --}}
        <script>
            var sline = {
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                series: [{
                    name: "Desktops",
                    data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                }],
                title: {
                    text: 'Product Trends by Month',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f1f2f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                }
            }

            var chart = new ApexCharts(
                document.querySelector("#s-line"),
                sline
            );

            chart.render();
        </script>
        {{-- Simple Column --}}
        <script>
            var sCol = {
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {
                        show: false,
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                series: [{
                    name: 'Net Profit',
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                }, {
                    name: 'Revenue',
                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                }],
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                },
                yaxis: {
                    title: {
                        text: '$ (thousands)'
                    }
                },
                fill: {
                    opacity: 1

                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return "$ " + val + " thousands"
                        }
                    }
                }
            }

            var chart = new ApexCharts(
                document.querySelector("#s-col"),
                sCol
            );

            chart.render();
        </script>

        <script>
            var d_1options3 = {
                chart: {
                    id: 'sparkline1',
                    type: 'area',
                    height: 160,
                    sparkline: {
                        enabled: true
                    },
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                series: [{
                    name: 'Usuarios',
                    data: [38, 60, 38, 52, 36, 40, 28]
                }],
                labels: ['1', '2', '3', '4', '5', '6', '7'],
                yaxis: {
                    min: 0
                },
                colors: ['#1b55e2'],
                tooltip: {
                    x: {
                        show: false,
                    }
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        type: "vertical",
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: .40,
                        opacityTo: .05,
                        stops: [45, 100]
                    }
                },
            }

            var d_1C_5 = new ApexCharts(document.querySelector("#hybrid_followers"), d_1options3);
            d_1C_5.render()
        </script>
        <script src="{{ asset('template/assets/js/scrollspyNav.js') }}"></script>
        <script src="{{ asset('template/plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('template/plugins/noUiSlider/nouislider.min.js') }}"></script>

        <script src="{{ asset('template/plugins/flatpickr/custom-flatpickr.js') }}"></script>
        <script src="{{ asset('template/plugins/noUiSlider/custom-nouiSlider.js') }}"></script>
        <script src="{{ asset('template/plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js') }}"></script>
    @endsection
