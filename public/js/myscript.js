var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}

// Delete Confirmation
$("#dltCat").click(function() {
    if (confirm("Are you sure you want to delete this?")) {
        return true;
    }
    return false;
});

// Get Sub Category with dropdown
$(document).ready(function() {
    $("#MainCategoryName").change(function() {
        var catId = $("#MainCategoryName Option:Selected").val();

        $.ajax({
            url: "/getSubCat/" + catId,
            type: "GET",
            dataType: "json",
            cache: false,
            success: function(data) {
                var s = "<option selected disabled>Select</option>";
                for (var i = 0; i < data.length; i++) {
                    s +=
                        '<option value="' +
                        data[i].id +
                        '">' +
                        data[i].name +
                        "</option>";
                }
                $("#SubCategoryName").html(s);
            }
        });
    });
});

// Input price 2 decimel
$(document).ready(function() {
    $("#inputPrice1").on("change", function() {
        var currentObj = $(this);
        var currentVal = currentObj.val();
        if (!isNaN(currentVal)) {
            var updatedVal = parseFloat(currentVal).toFixed(2);
            currentObj.val(updatedVal);
        } else {
            currentObj.val("");
        }
    });
});

$(document).ready(function() {
    $("#inputPrice2").on("blur", function() {
        var currentObj = $(this);
        var currentVal = currentObj.val();
        if (!isNaN(currentVal)) {
            var updatedVal = parseFloat(currentVal).toFixed(2);
            currentObj.val(updatedVal);
        } else {
            currentObj.val("");
        }
    });
});

$(document).ready(function() {
    $("#inputPrice3").on("blur", function() {
        var currentObj = $(this);
        var currentVal = currentObj.val();
        if (!isNaN(currentVal)) {
            var updatedVal = parseFloat(currentVal).toFixed(2);
            currentObj.val(updatedVal);
        } else {
            currentObj.val("");
        }
    });
});

// active nav
$(function() {
    var url = window.location.href;

    $(".nav li a").each(function() {
        if (url == this.href) {
            $(this)
                .closest("li")
                .addClass("active");
            $(this)
                .closest("li")
                .parent()
                .parent()
                .addClass("open active")
                .parents(".root-level")
                .addClass("open active");
            $(this)
                .closest("li")
                .parent()
                .parent()
                .addClass("open active")
                .parents(".sub-root-level")
                .addClass("open active")
                .parents(".root-level")
                .addClass("open active");
        }
    });
});

$(document).ready(function() {
    $("#owl-demo").owlCarousel({
        autoPlay: 3000,
        stopOnHover: true,
        navigation: true,
        paginationSpeed: 1000,
        goToFirstSpeed: 2000,
        singleItem: true,
        autoHeight: true,
        items: 1
    });
});

$('#inputGroupFile02').on('change',function(){
    //get the file name
    var fileName = $(this).val();
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
})