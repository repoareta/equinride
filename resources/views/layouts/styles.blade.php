<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

<!--end::Fonts-->

<!--begin::Page Vendors Styles(used by this page)-->
<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/custom/leaflet/leaflet.bundle.css" rel="stylesheet" type="text/css" />

<!--end::Page Vendors Styles-->

<!--begin::Global Theme Styles(used by all pages)-->
<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />

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
        text-align: center;
        font-size: 9px;
        padding: 2px 3px;
        line-height: .9;
        border-radius: inherit;
        width: 70px;
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
</style>