//* Checkboxes select all
$(document).ready(function () {
    $("#selectAllBoxes").click(function (e) {
        if (this.checked) {
            $(".checkBoxes").each(function () {
                this.checked = true;
            });
        } else {
            $(".checkBoxes").each(function () {
                this.checked = false;
            });
        }
    });
});

//* Za brisanje korisnika iz CMS
function deleteUser(item) {
    if (confirm("Are you sure?")) {
        const formData = {id: item};
        $.ajax({
            type: "POST",
            url: "http://localhost/users/" + formData.id + "/delete",
            data: formData,
            success: function (response) {
                if (response.error) {
                    console.log(response.error);
                    alert(response.error);
                } else {
                    console.log("Izbrisan User ID: " + formData.id);

                    // window.location.reload(true);
                    $(".row-user")
                        .filter(function () {
                            return $(this).data("id") === formData.id;
                        })
                        .css("background-color", "#ECECEC")
                        .fadeOut("slow");
                }
            },
            error: function (error) {
                console.log(error);
                alert("Greška, učitajte ponovo");
            },
            async: false,
        });
    }
}

//* Edit user in modal form
$(document).on("click", "#edituser", function () {
    $("#editModalLabel").html("Edit user data");
    // $(".modal-body form").attr("action", "http://localhost/ramonda/users/update");

    const id = $(this).data("id");

    $.ajax({
        url: "http://localhost/ramonda/users/edit",
        data: {user_id: id},
        method: "POST",
        dataType: "JSON",
        success: function (data) {
            if (data.error) {
                console.log(data.error);
                alert(data.error);
            } else {
                console.log(data[0]);

                $("#id").val(data[0].id);
                $("#name").val(data[0].name);
                $("#username").val(data[0].username);
                $("#email").val(data[0].email);
                // $("#password").val(data[0].password);
                $("#address").val(data[0].address);
                $("#city").val(data[0].city);
                $("#country").val(data[0].country);
                $("#phone").val(data[0].phone);
                $("#zip").val(data[0].zip);
                $("#is_admin").val(data[0].is_admin);
            }
        },
        error: function (error) {
            console.log(error);
            alert("Greška, učitajte ponovo");
        },
        async: false,
    });
});

// //* Comtrade products I nacin
// async function getData(url = "") {
//     // Default options are marked with *
//     const response = await fetch(url, {
//         method: "GET", // *GET, POST, PUT, DELETE, etc.
//         mode: "cors", // no-cors, *cors, same-origin
//         cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
//         credentials: "same-origin", // include, *same-origin, omit
//         headers: {
//             "Content-Type": "application/json",
//             // 'Content-Type': 'application/x-www-form-urlencoded',
//         },
//         redirect: "follow", // manual, *follow, error
//         referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
//         body: JSON.stringify(), // body data type must match "Content-Type" header
//     });
//     return response.json(); // parses JSON response into native JavaScript objects
// }
//
// //todo POZIVANJE OVE GORNJE FUNKCIJE
// //* Comtrade JS
// document.querySelector("body").addEventListener("DOMContentLoaded", getData);
// getData("http://localhost/ramonda/public/json/cjenovnik-comtrade.json")
//     .then((data) => {
//         // console.log(data);
//         let output = "";
//         let i = 0;
//         data.forEach((item) => {
//             i++;
//             output += `
//                 <tr>
// <td>${item.naziv.substring(0, 30)}</td>
// <td>${item.proizvodjac}</td>
// <td>${item.grupa}</td>
// <td>${item.vpc_sa_pdv}</td>
// <td>${item.vpcena}</td>
// <td>${item.GS}</td>
// <td>${item.Barcode}</td>
//
// </tr>`;
//         });
//         $("#main").html(output);
//     })
//     .catch((err) => console.log(err));

//? ########################################################

//! Comtrade funkcija II(stariji) nacin
// function getJSON() {
//     fetch("http://localhost/ramonda/public/json/cjenovnik-comtrade.json")
//         .then((res) => res.json())
//         .then((data) => {
//             console.log(data);
//             let output = '';
//             let i = 0;
//             data.forEach(item => {
//                 i++;
//                 output += `
//                 <tr>
// <td>${item.naziv.substring(0, 30)}</td>
// <td>${item.proizvodjac}</td>
// <td>${item.grupa}</td>
// <td>${item.vpc_sa_pdv}</td>
// <td>${item.vpcena}</td>
// <td>${item.GS}</td>
// <td>${item.Barcode}</td>
// <td class="d-flex justify-content-center">
//   <div class="d-inline-flex">
//     <div class="px-1">
//       <a
//         href="#"
//         id="edituser"
//         class="text-primary"
//         data-bs-toggle="modal"
//         data-bs-target="#editModal"
//         data-id="${i}"
//       >
//         <i class="bi bi-pencil-square"></i>
//       </a>
//     </div>

//     <div class="px-1">
//       <a href="#" class="text-danger">
//         <i class="bi bi-x-square-fill"></i>
//       </a>
//     </div>
//   </div>
// </td>
// </tr>`;
//             });
//             document.getElementById("main").innerHTML = output;
//         })
//         .catch((err) => console.log(err));
// }
//

//? #################################################################

//* Za brisanje sesije iz CMS
function deleteSession(item) {
    if (confirm("Are you sure?")) {
        var formData = {
            session_id: item,
        };
        $.ajax({
            type: "POST",
            url: "http://localhost/ramonda/sessions/delete",
            data: formData,
            success: function (response) {
                if (response.error) {
                    console.log(response.error);
                    alert(response.error);
                } else {
                    console.log("Izbrisano: " + formData.session_id);
                    // window.location.reload(true);

                    $(".row-session[data-id=" + formData.session_id + "]")
                        .css("background-color", "#ECECEC")
                        .fadeOut("slow");
                }
            },
            error: function (error) {
                console.log(error);
                alert("Greška, učitajte ponovo");
            },
            async: false,
        });
    }
}

//? ####################################
$(document).ready(function () {
    $("#inputPhone").mask("+000 00 000 000 0");
    $("#phone").mask("+000 00 000 000 0");
    $("#zip").mask("00000-000");
    $("#inputZip").mask("00000-000");
});

//? ### ADD NEW BUTTON ########
/* <button class="btn btn-primary">Add new</button>; */
$(document).ready(function () {
    if (
        window.location.href == "http://localhost/ramonda/admin/users" ||
        window.location.href == "http://localhost/ramonda/admin/users#" ||
        window.location.href == "http://localhost/ramonda/admin/users#!" ||
        window.location.href == "http://localhost/ramonda/admin/users?success"
    ) {
        $(".dataTable-search").addClass("d-flex");
        $(".dataTable-input").addClass("search-user");
        $(
            "<button id='addUser' data-bs-toggle='modal' data-bs-target='#addModal' class='btn btn-primary text-white addUser'>Add new</button>"
        ).insertBefore(".dataTable-input");
        $(".dataTable-input").width("69%");
        $(".addUser").addClass("mr-1");

        //dropdown
        $(".dataTable-dropdown label").append(
            "<label id='bulkOption' class='ml-2'><input type='button' name='btn_delete' id='btn_delete' class='btn btn-danger' value='Delete'/></label>"
        );

        //* Brisanje sortera za checkbox na th tag
        $("#datatablesSimple thead tr th")
            .find("a")
            .first()
            .removeClass("dataTable-sorter");
    }

    if (
        window.location.href == "http://localhost/ramonda/admin/sessions" ||
        window.location.href == "http://localhost/ramonda/admin/sessions#" ||
        window.location.href == "http://localhost/ramonda/admin/sessions#!"
    ) {
        $(".dataTable-input").width("69%");
        $(".addUser").addClass("mr-1");

        //dropdown
        $(".dataTable-dropdown label").append(
            "<label id='bulkOption' class='ml-2'><input type='button' name='btn_delete_session' id='btn_delete_session' class='btn btn-danger' value='Delete'/></label>"
        );

        $("#datatablesSimple thead tr th")
            .find("a")
            .first()
            .removeClass("dataTable-sorter");
    }
});

//? delete USER on checkbox
$(document).on("click", "#btn_delete", function () {
    if (confirm("Are you sure you want to delete this?")) {
        const id = [];
        //
        $(":checkbox:checked").each(function (i) {
            id[i] = $(this).data("id");
            console.log(id[i]);

            $.ajax({
                url: "http://localhost/ramonda/users/delete",
                method: "POST",
                data: {id: id[i]},
                success: function (data) {
                    if (data.error) {
                        console.log(data.error);
                        alert(data.error);
                    } else {
                        console.log("Izbrisano");

                        $(".row-user")
                            .filter(function () {
                                return $(this).data("id") === id[i];
                            })
                            .css("background-color", "#ECECEC")
                            .fadeOut("slow");
                    }
                },
                error: function (error) {
                    console.log(error);
                    alert("Greška, učitajte ponovo");
                },
                async: false,
            });
        });
    }
});

//? delete SESSION on checkbox
$(document).on("click", "#btn_delete_session", function () {
    if (confirm("Are you sure you want to delete this?")) {
        const id = [];
        //
        $(":checkbox:checked").each(function (i) {
            id[i] = $(this).data("id");
            console.log(id[i]);

            $.ajax({
                url: "http://localhost/ramonda/sessions/delete",
                method: "POST",
                data: {session_id: id[i]},
                success: function (data) {
                    if (data.error) {
                        console.log(data.error);
                        alert(data.error);
                    } else {
                        console.log("Izbrisano");

                        $(".row-session")
                            .filter(function () {
                                return $(this).data("id") === id[i];
                            })
                            .css("background-color", "#ECECEC")
                            .fadeOut("slow");
                    }
                },
                error: function (error) {
                    console.log(error);
                    alert("Greška, učitajte ponovo");
                },
                async: false,
            });
        });
    }
});


