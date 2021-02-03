<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

<!--end::Fonts-->

<!--begin::Page Vendors Styles(used by this page)-->
<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/leaflet/leaflet.bundle.css') }}" rel="stylesheet" type="text/css" />

@stack("page-styles")
<!--end::Page Vendors Styles-->

<!--begin::Global Theme Styles(used by all pages)-->
<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

<link rel="shortcut icon" href="{{ asset('assets/media/branchsto/favicon-1.ico') }}" />

<!--end::Global Theme Styles-->

<!--begin::Layout Themes(used by all pages)-->

<!--end::Layout Themes-->

{{-- custom style start --}}
<style>
    .aside {
        background-color: #292d46;
    }

    .menu-link span.label.label-danger {
        position: absolute;
        top: -4px;
        right: 4px;
    }

    .scroll {
        white-space: nowrap; /* [1] */
        overflow-x: auto; /* [2] */
        -webkit-overflow-scrolling: touch; /* [3] */
        -ms-overflow-style: -ms-autohiding-scrollbar; /* [4] */ 
    }

    /* [5] */
    .scroll::-webkit-scrollbar {
    display: none; 
    }

    .carousel-content {
        position: absolute;
        left: 30px;
        top: 50px;
        width: 70%;
        z-index: 2;
    }

    .carousel-content .title {
        font-weight: 900;
        font-size: 30px;
        color: #ffffff;
    }

    ol.carousel-indicators {
        justify-content: unset;
        margin-right: unset;
        margin-left: unset;
        left: unset;
        right: 30px;
        bottom: 10px;
    }

    .carousel-content .subtitle {
        font-weight: normal;
        font-size: 16px;
        color: #ffffff;
    }

    .help-block.error-help-block{
        color: red;
    }

    .dropzone .dz-preview .dz-error-message {
        top: 150px!important;
    }

    .dropzone.dropzone-default .dz-remove {
        font-size: 10px;
    }
</style>
