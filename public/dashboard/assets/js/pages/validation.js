$(document).ready(function () {
    var isEdit = "{{ isset($product) ? 'true' : 'false' }}" === 'true'; // Check if it's an edit form

    var productValidator = $("#productForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            category_ids: {
                required: true,
                minlength: 1
            },
            unit_price: {
                required: true,
                number: true,
                min: 0
            },
            selling_price: {
                required: true,
                number: true,
                min: 0
            },
            offer_price: {
                number: true,
                min: 0
            },
            stock_quantity: {
                required: true,
                number: true,
                min: 0
            },
            status: {
                required: false
            },
            in_stock: {
                required: false
            },
            feature_tag: {
                required: false
            },
            image: {
                required: !isEdit, // Required only on create, not on edit
                extension: "jpg|jpeg|png|gif|webp"
            }
        },
        messages: {
            name: {
                required: "Product name is required",
                minlength: "Product name must be at least 3 characters"
            },
            category_ids: {
                required: "Please select at least one category"
            },
            unit_price: {
                required: "Unit price is required",
                number: "Please enter a valid number",
                min: "Price must be at least 0"
            },
            selling_price: {
                required: "Selling price is required",
                number: "Please enter a valid number",
                min: "Price must be at least 0"
            },
            offer_price: {
                number: "Please enter a valid number",
                min: "Price must be at least 0"
            },
            stock_quantity: {
                required: "Stock quantity is required",
                number: "Please enter a valid number",
                min: "Quantity must be at least 0"
            },
            image: {
                required: "Product image is required",
                extension: "Only JPG, JPEG, PNG, GIF, or WEBP files are allowed"
            }
        },
        errorPlacement: function (error, element) {
            error.addClass("text-danger").insertAfter(element);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $("button[type='submit']").click(function () {
        if (!$("#productForm").valid()) {
            productValidator.focusInvalid();
        }
    });
});

$(document).ready(function () {
    var isEdit = "{{ isset($homesection) ? 'true' : 'false' }}" === 'true';

    var homeSectionValidator = $("#homeSectionForm").validate({
        rules: {
            title: {
                required: true,
                minlength: 5
            },
            short_desc: {
                required: true,
                minlength: 10
            },
            bg_image: {
                required: !isEdit, // Required only on create
                extension: "jpg|jpeg|png|gif|webp"
            },
            mockup_image: {
                required: !isEdit, // Required only on create
                extension: "jpg|jpeg|png|gif|webp"
            },
            type: {
                required: true // Add required validation for section type
            },
            status: {
                required: false // status checkbox is optional
            }
        },
        messages: {
            title: {
                required: "Title is required",
                minlength: "Title must be at least 5 characters"
            },
            short_desc: {
                required: "Short description is required",
                minlength: "Short description must be at least 10 characters"
            },
            bg_image: {
                required: "Background image is required",
                extension: "Only JPG, JPEG, PNG, GIF, or WEBP files are allowed"
            },
            mockup_image: {
                required: "Mockup image is required",
                extension: "Only JPG, JPEG, PNG, GIF, or WEBP files are allowed"
            },
            type: {
                required: "Section type is required" // Error message for section type
            }
        },
        errorPlacement: function (error, element) {
            error.addClass("text-danger").insertAfter(element);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $("button[type='submit']").click(function () {
        if (!$("#homeSectionForm").valid()) {
            homeSectionValidator.focusInvalid();
        }
    });
});


$(document).ready(function () {
    var isEdit = "{{ isset($banner) ? 'true' : 'false' }}" === 'true';
    var bannerValidator = $("#HomeBannerForm").validate({
        rules: {
            title: {
                required: true,
                minlength: 3
            },
            sub_title: {
                required: true,
                minlength: 3
            },
            image: {
                required: !isEdit, // required only on create
                extension: "jpg|jpeg|png|gif|webp"
            },
            cta_text: {
                required: true,
                minlength: 2
            },
            cta_url: {
                required: true,
                url: true
            }
        },
        messages: {
            title: {
                required: "Banner title is required",
                minlength: "Title must be at least 3 characters"
            },
            sub_title: {
                required: "Sub title is required",
                minlength: "Sub title must be at least 3 characters"
            },
            image: {
                required: "Banner image is required",
                extension: "Only JPG, JPEG, PNG, GIF, or WEBP files are allowed"
            },
            cta_text: {
                required: "CTA text is required",
                minlength: "CTA text must be at least 2 characters"
            },
            cta_url: {
                required: "CTA URL is required",
                url: "Please enter a valid URL (e.g. https://example.com)"
            }
        },
        errorPlacement: function (error, element) {
            error.addClass("text-danger").insertAfter(element);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        },
        submitHandler: function (form) {
            form.submit();
        }
    });


    $("button[type='submit']").click(function () {
        if (!$("#HomeBannerForm").valid()) {
            bannerValidator.focusInvalid();
        }
    });
});

$(document).ready(function () {
    let isEdit = false; // Adjust if you want to handle edit conditionally

    const categoryValidator = $("#categoryForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            parent_id: {
                required: false // Optional, but you can make it required if needed
            },
            description: {
                required: false,
                minlength: 5
            },
            image: {
                required: !isEdit, // Only required when creating
                extension: "jpg|jpeg|png|gif|webp"
            }
        },
        messages: {
            name: {
                required: "Category name is required",
                minlength: "Name must be at least 2 characters"
            },
            description: {
                minlength: "Description must be at least 5 characters"
            },
            image: {
                required: "Image is required",
                extension: "Only JPG, JPEG, PNG, GIF, or WEBP files are allowed"
            }
        },
        errorPlacement: function (error, element) {
            error.addClass("text-danger").insertAfter(element);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $("button[type='submit']").click(function () {
        if (!$("#categoryForm").valid()) {
            categoryValidator.focusInvalid();
        }
    });
});

$(document).ready(function () {
    var isEdit = "{{ isset($user) ? 'true' : 'false' }}" === 'true';

    var userValidator = $("#userForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 10,
                digits: true
            },
            password: {
                required: !isEdit, // Password is required only when creating a new user
                minlength: 6
            },
            roles: {
                required: true
            },
            status: {
                required: false // Status checkbox is optional
            }
        },
        messages: {
            name: {
                required: "Name is required",
                minlength: "Name must be at least 3 characters"
            },
            email: {
                required: "Email is required",
                email: "Please enter a valid email address"
            },
            phone: {
                required: "Phone number is required",
                minlength: "Phone number must be at least 10 digits",
                digits: "Please enter a valid phone number"
            },
            password: {
                required: "Password is required",
                minlength: "Password must be at least 6 characters"
            },
            roles: {
                required: "User role is required"
            },
        },
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.addClass("text-danger").insertAfter(element.parent());
            } else {
                error.addClass("text-danger").insertAfter(element);
            }
        },
        highlight: function (element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    $("button[type='submit']").click(function () {
        if (!$("#userForm").valid()) {
            userValidator.focusInvalid();
        }
    });
});

$(document).ready(function () {
    // Determine if it's an edit form
    var isEdit = "{{ isset($faq) ? 'true' : 'false' }}" === 'true';

    var faqValidator = $("#faqForm").validate({
        rules: {
            question: {
                required: true,
                minlength: 10
            },
            answer: {
                required: true,
                minlength: 20
            },
            status: {
                required: false // status is not required since it's a checkbox
            }
        },
        messages: {
            question: {
                required: "Question is required",
                minlength: "Question must be at least 10 characters"
            },
            answer: {
                required: "Answer is required",
                minlength: "Answer must be at least 20 characters"
            }
        },
        errorPlacement: function (error, element) {
            error.addClass("text-danger").insertAfter(element);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    // On submit button click, check if form is valid
    $("button[type='submit']").click(function () {
        if (!$("#faqForm").valid()) {
            faqValidator.focusInvalid();
        }
    });
});

// $(document).ready(function () {
//     var isEdit = "{{ isset($companyinfo) ? 'true' : 'false' }}" === 'true';

//     var companyInfoValidator = $("#CompanyInfoForm").validate({
//         rules: {
//             company_intro: {
//                 required: true,
//                 minlength: 10
//             },
//             phone: {
//                 required: true,
//                 minlength: 10,
//                 maxlength: 15,
//                 digits: true
//             },
//             email: {
//                 required: true,
//                 email: true
//             },
//             address: {
//                 required: true,
//                 minlength: 10
//             },
//             mission: {
//                 required: true,
//                 minlength: 10
//             },
//             vision: {
//                 required: true,
//                 minlength: 10
//             },
//             about_short_desc: {
//                 required: true,
//                 minlength: 10
//             },
//             about_desc: {
//                 required: true,
//                 minlength: 15
//             }
//         },
//         messages: {
//             company_intro: {
//                 required: "Company introduction is required",
//                 minlength: "Company introduction must be at least 10 characters"
//             },
//             phone: {
//                 required: "Phone number is required",
//                 minlength: "Phone number must be at least 10 digits",
//                 maxlength: "Phone number cannot exceed 15 digits",
//                 digits: "Phone number must be a valid number"
//             },
//             email: {
//                 required: "Email is required",
//                 email: "Please enter a valid email address"
//             },
//             address: {
//                 required: "Address is required",
//                 minlength: "Address must be at least 10 characters"
//             },
//             mission: {
//                 required: "Mission is required",
//                 minlength: "Mission must be at least 10 characters"
//             },
//             vision: {
//                 required: "Vision is required",
//                 minlength: "Vision must be at least 10 characters"
//             },
//             about_short_desc: {
//                 required: "Short description is required",
//                 minlength: "Short description must be at least 10 characters"
//             },
//             about_desc: {
//                 required: "Full description is required",
//                 minlength: "Full description must be at least 15 characters"
//             }
//         },
//         errorPlacement: function (error, element) {
//             error.addClass("text-danger").insertAfter(element);
//         },
//         highlight: function (element) {
//             $(element).addClass("is-invalid").removeClass("is-valid");
//         },
//         unhighlight: function (element) {
//             $(element).removeClass("is-invalid").addClass("is-valid");
//         },
//         submitHandler: function (form) {
//             form.submit();
//         }
//     });

//     $("button[type='submit']").click(function () {
//         if (!$("#CompanyInfoForm").valid()) {
//             companyInfoValidator.focusInvalid();
//         }
//     });
// });





        
                

