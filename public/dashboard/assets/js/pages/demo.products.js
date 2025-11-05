$(document).ready(function () {
    "use strict";

    $("#products-datatable").DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'></i>",
                next: "<i class='mdi mdi-chevron-right'></i>"
            },
            info: "Showing Rows _START_ to _END_ of _TOTAL_",
            lengthMenu: 'Display <select class="form-select form-select-sm ms-1 me-1">' +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="-1">All</option>' +
                '</select> Rows'
        },
        pageLength: 10,
        columns: [
            { orderable: true },
            { orderable: true },
            { orderable: true },
            { orderable: true },
            { orderable: true },
            { orderable: true },
            { orderable: false }
        ],
        order: [[0, "asc"]],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            $("#products-datatable_length label").addClass("form-label");
            document.querySelector(".dataTables_wrapper .row")
                .querySelectorAll(".col-md-6")
                .forEach(function (element) {
                    element.classList.add("col-sm-6");
                    element.classList.remove("col-sm-12", "col-md-6");
                });
        }
    });
});
// Initialize Social Media Datatable
$("#socialmedia-datatable").DataTable({
    language: {
        paginate: {
            previous: "<i class='mdi mdi-chevron-left'></i>",
            next: "<i class='mdi mdi-chevron-right'></i>"
        },
        info: "Showing Rows _START_ to _END_ of _TOTAL_",
        lengthMenu: 'Display <select class="form-select form-select-sm ms-1 me-1">' +
            '<option value="5">5</option>' +
            '<option value="10">10</option>' +
            '<option value="20">20</option>' +
            '<option value="-1">All</option>' +
            '</select> Rows'
    },
    pageLength: 10,
    columns: [
        { orderable: true },
        { orderable: true },
        { orderable: false }
    ],
    order: [[0, "asc"]],
    drawCallback: function () {
        $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
        $("#socialmedia-datatable_length label").addClass("form-label");
        // ... rest of your drawCallback
    }
});
$(document).ready(function() {
    $('#product-datatable').DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'></i>",
                next: "<i class='mdi mdi-chevron-right'></i>"
            },
            info: "Showing _START_ to _END_ of _TOTAL_ products",
            lengthMenu: 'Display <select class="form-select form-select-sm ms-1 me-1">' +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="-1">All</option>' +
                '</select> products'
        },
        pageLength: 10,
        columns: [
            { orderable: true },  // Image
            { orderable: true },  // Name
            { orderable: true },   // Categories
            { orderable: true },  //short_desc
            { orderable: true },  // Date
            { orderable: true },  // Price
            { orderable: true },  // Quantity
            { orderable: true },  // Status
            { orderable: false } // Action
        ],
        order: [[3, "desc"]], // Default sort by Added Date (newest first)
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            $("#product-datatable_length label").addClass("form-label");
        }
    });
});
$(document).ready(function() {
    $('#orders-datatable').DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'></i>",
                next: "<i class='mdi mdi-chevron-right'></i>"
            },
            info: "Showing _START_ to _END_ of _TOTAL_ orders",
            lengthMenu: 'Display <select class="form-select form-select-sm ms-1 me-1">' +
                '<option value="10">10</option>' +
                '<option value="25">25</option>' +
                '<option value="50">50</option>' +
                '<option value="100">100</option>' +
                '</select> orders',
            emptyTable: "No orders available",
            zeroRecords: "No matching orders found"
        },
        pageLength: 10,
        order: [[1, 'desc']], // Default sort by date (newest first)
        columns: [
            { orderable: true },  // Order Number
            { orderable: true },  // Date
            { 
                orderable: true,
                type: 'string',  // Ensures proper sorting of payment status
                render: function(data, type, row) {
                    // For sorting, return the raw status value
                    if (type === 'sort') {
                        return $(data).text().trim();
                    }
                    return data;
                }
            },
            { 
                orderable: true,
                type: 'num-fmt'  // For proper numeric sorting of currency
            },
            { 
                orderable: true,
                type: 'string',  // Ensures proper sorting of order status
                render: function(data, type, row) {
                    // For sorting, return the raw status value
                    if (type === 'sort') {
                        return $(data).text().trim();
                    }
                    return data;
                }
            },
            { orderable: false }  // Action
        ],
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            $("#orders-datatable_length label").addClass("form-label");
        },
        createdRow: function(row, data, dataIndex) {
            // Add responsive class to the row
            $(row).addClass('dt-row');
        }
    });
});
$(document).ready(function() {
    $('#customer-datatable').DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'></i>",
                next: "<i class='mdi mdi-chevron-right'></i>"
            },
            info: "Showing _START_ to _END_ of _TOTAL_ customers",
            lengthMenu: 'Display <select class="form-select form-select-sm ms-1 me-1">' +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="-1">All</option>' +
                '</select> customers'
        },
        pageLength: 20,
        columns: [
            { orderable: false },  // User Image (no sorting)
            { orderable: true },   // Name
            { orderable: true },   // Email
            { orderable: true },   // Contact No.
            { orderable: true }    // Role
        ],
        order: [[1, "asc"]], // Default sort by Name (A-Z)
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            $("#customer-datatable_length label").addClass("form-label");
        }
    });
});
$(document).ready(function() {
    $('#categories-datatable').DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'></i>",
                next: "<i class='mdi mdi-chevron-right'></i>"
            },
            info: "Showing _START_ to _END_ of _TOTAL_ categories",
            lengthMenu: 'Display <select class="form-select form-select-sm ms-1 me-1">' +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="-1">All</option>' +
                '</select> categories'
        },
        pageLength: 10,
        columns: [
            { 
                orderable: false,  // Image column (no sorting)
                searchable: false 
            },
            { orderable: true },   // Name
            { orderable: true },   // Description
            { orderable: true },   // Status
            { 
                orderable: false,  // Action
                searchable: false 
            }
        ],
        order: [[1, "asc"]], // Default sort by Name (A-Z)
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            $("#categories-datatable_length label").addClass("form-label");
            
            // Match customer table's column adjustment
            document.querySelector(".dataTables_wrapper .row")
                .querySelectorAll(".col-md-6")
                .forEach(function(element) {
                    element.classList.add("col-sm-6");
                    element.classList.remove("col-sm-12", "col-md-6");
                });
        }
    });
});
$(document).ready(function () {
    $('#inbox-datatable').DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'></i>",
                next: "<i class='mdi mdi-chevron-right'></i>"
            },
            info: "Showing _START_ to _END_ of _TOTAL_ messages",
            lengthMenu: 'Display <select class="form-select form-select-sm ms-1 me-1">' +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="-1">All</option>' +
                '</select> messages'
        },
        pageLength: 10,
        columns: [
            { orderable: true },  
            { orderable: false }, 
            { orderable: true }   
        ],
        order: [[2, "desc"]], 
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            $("#inbox-datatable_length label").addClass("form-label");

            // Optional: Adjust Bootstrap grid layout
            document.querySelector(".dataTables_wrapper .row")
                .querySelectorAll(".col-md-6")
                .forEach(function (element) {
                    element.classList.add("col-sm-6");
                    element.classList.remove("col-sm-12", "col-md-6");
                });
        }
    });
});
$(document).ready(function() {
    $('#faqs-datatable').DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'></i>",
                next: "<i class='mdi mdi-chevron-right'></i>"
            },
            info: "Showing _START_ to _END_ of _TOTAL_ FAQs",
            lengthMenu: 'Display <select class="form-select form-select-sm ms-1 me-1">' +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="-1">All</option>' +
                '</select> FAQs',
            emptyTable: "No FAQs available"
        },
        pageLength: 10,
        columns: [
            { 
                orderable: true,   // Question
                searchable: true
            },
            { 
                orderable: false,  // Answer (truncated)
                searchable: true,
                render: function(data, type, row) {
                    // For display, show truncated text. For searching, use full text
                    return type === 'display' ? data : row[3]; // row[3] would contain full answer
                }
            },
            { orderable: true },   // Status
            { 
                orderable: false,  // Action
                searchable: false 
            }
        ],
        order: [[2, "desc"], [0, "asc"]], // Sort by Status (active first) then Question
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            $("#faqs-datatable_length label").addClass("form-label");
            
            // Standard column adjustment
            document.querySelector(".dataTables_wrapper .row")
                .querySelectorAll(".col-md-6")
                .forEach(function(element) {
                    element.classList.add("col-sm-6");
                    element.classList.remove("col-sm-12", "col-md-6");
                });
        }
    });
});
$(document).ready(function() {
    $('#home-sections-datatable').DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'></i>",
                next: "<i class='mdi mdi-chevron-right'></i>"
            },
            info: "Showing _START_ to _END_ of _TOTAL_ sections",
            lengthMenu: 'Display <select class="form-select form-select-sm ms-1 me-1">' +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="-1">All</option>' +
                '</select> sections',
            emptyTable: "No sections available"
        },
        pageLength: 10,
        columns: [
            { 
                orderable: false,  // Background Image
                searchable: false
            },
            { 
                orderable: false,  // Mockup Image
                searchable: false
            },
            { 
                orderable: true,   // Title
                searchable: true
            },
            { 
                orderable: false,   // Short Description
                searchable: true,
                render: function(data, type, row) {
                    // For display, show truncated text
                    return type === 'display' && data.length > 30 ? 
                        data.substr(0, 30) + '...' : data;
                }
            },
            { 
                orderable: true,    // Status
                searchable: false
            },
            { 
                orderable: false,   // Action
                searchable: false 
            }
        ],
        order: [[2, "asc"]], // Default sort by Title (A-Z)
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            $("#home-sections-datatable_length label").addClass("form-label");
            
            // Standard column adjustment
            document.querySelector(".dataTables_wrapper .row")
                .querySelectorAll(".col-md-6")
                .forEach(function(element) {
                    element.classList.add("col-sm-6");
                    element.classList.remove("col-sm-12", "col-md-6");
                });
        }
    });
});
$(document).ready(function() {
    $('#banner-datatable').DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'></i>",
                next: "<i class='mdi mdi-chevron-right'></i>"
            },
            info: "Showing _START_ to _END_ of _TOTAL_ banners",
            lengthMenu: 'Display <select class="form-select form-select-sm ms-1 me-1">' +
                '<option value="10">10</option>' +
                '<option value="25">25</option>' +
                '<option value="50">50</option>' +
                '<option value="-1">All</option>' +
                '</select> banners'
        },
        pageLength: 10,
        columns: [
            { orderable: false, searchable: false }, // Image
            { orderable: true },                     // Title
            { orderable: true },                     // Sub Title
            { orderable: true },                     // CTA Text
            { 
                orderable: false,                    // CTA URL (link)
                searchable: true 
            },
            { 
                orderable: false,                    // Action (edit/delete icons)
                searchable: false 
            }
        ],
        order: [[1, "asc"]], // Sort by Title
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            $("#banner-datatable_length label").addClass("form-label");

            document.querySelector(".dataTables_wrapper .row")
                .querySelectorAll(".col-md-6")
                .forEach(function(element) {
                    element.classList.add("col-sm-6");
                    element.classList.remove("col-sm-12", "col-md-6");
                });
        }
    });
});
$(document).ready(function () {
    "use strict";

    $("#stock-datatable").DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'></i>",
                next: "<i class='mdi mdi-chevron-right'></i>"
            },
            info: "Showing Rows _START_ to _END_ of _TOTAL_",
            lengthMenu: 'Display <select class="form-select form-select-sm ms-1 me-1">' +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="-1">All</option>' +
                '</select> Rows'
        },
        pageLength: 20,
        columns: [
            { orderable: true }, // No.
            { orderable: true }, // Product ID
            { orderable: true }, // Product Name
            { orderable: true }, //Unit Price
            { orderable: true }, // status
            { orderable: true }  // Quantity
        ],
        order: [[0, "asc"]],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            $("#stock-datatable_length label").addClass("form-label");
            document.querySelector(".dataTables_wrapper .row")
                .querySelectorAll(".col-md-6")
                .forEach(function (element) {
                    element.classList.add("col-sm-6");
                    element.classList.remove("col-sm-12", "col-md-6");
                });
        }
    });
});


// $(document).ready(function(){"use strict";$("#products-datatable").DataTable({language:{paginate:{previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"},info:"Showing products _START_ to _END_ of _TOTAL_",lengthMenu:'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select> products'},pageLength:5,columns:[{orderable:!1,targets:0,render:function(e,l,a,o){return e="display"===l?'<div class="form-check"><input type="checkbox" class="form-check-input dt-checkboxes"><label class="form-check-label">&nbsp;</label></div>':e},checkboxes:{selectRow:!0,selectAllRender:'<div class="form-check"><input type="checkbox" class="form-check-input dt-checkboxes"><label class="form-check-label">&nbsp;</label></div>'}},{orderable:!0},{orderable:!0},{orderable:!0},{orderable:!0},{orderable:!0},{orderable:!0},{orderable:!1}],select:{style:"multi"},order:[[1,"asc"]],drawCallback:function(){$(".dataTables_paginate > .pagination").addClass("pagination-rounded"),$("#products-datatable_length label").addClass("form-label"),document.querySelector(".dataTables_wrapper .row").querySelectorAll(".col-md-6").forEach(function(e){e.classList.add("col-sm-6"),e.classList.remove("col-sm-12"),e.classList.remove("col-md-6")})}})});
