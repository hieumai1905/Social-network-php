$(document).ready(function () {
    GetContact();
    var contactitem = document.getElementsByClassName('contactitem');
    for (let i = 0; i < contactitem.length; i++) {
        contactitem[i].addEventListener("click", function () {
            localStorage.setItem("userTargetId", contactitem[i].getAttribute('name'));
        })
    }
})
const currentUserIdContact = localStorage.getItem('userId');
function GetContact() {
    $.ajax({
        url: 'https://localhost:7131/v1/api/users/' + currentUserIdContact + '/friends',
        method: 'GET',
        dataType: 'json',
        contentType: 'json',
        async: false,
        xhrFields: {
            withCredentials: true
        },
        success: function (contact) {
            let listContact = '';
            let userContact = '';
            let avatarContact = '';
            let userContactId = '';
            for (var i = 0, len = contact.length; i < len; i++) {
                $.ajax({
                    url: 'https://localhost:7131/v1/api/users/' + contact[i].userTargetIduserId,
                    method: 'GET',
                    contentType: 'json',
                    dataType: 'json',
                    async: false,
                    xhrFields: {
                        withCredentials: true
                    },
                    success: function (user) {
                        userContact = user.fullName;
                        avatarContact = user.avatar;
                        userContactId = user.userTargetIduserId;
                    }
                });
                listContact += `<li class="contactItems" class="bg-transparent list-group-item no-icon pe-0 ps-0 pt-2 pb-2 border-0 d-flex align-items-center">
                            <figure class="avatar float-left mb-0 me-2">
                                <img src="${avatarContact}" alt="image" style="border-radius:50px; width: 35px; height: 35px;"/><!--User avatar in here-->
                            </figure>
                            <h3 class="fw-700 mb-0 mt-0">
                                <a name="${contact[i].userTargetIduserId}" class="contactitem font-xssss text-grey-600 d-block text-dark model-popup-chat"
                                   href="https://localhost:7261/messenger">
                                    ${userContact}
                                </a>
                            </h3>
                        </li>`;
            }
            document.getElementById('contact').innerHTML = listContact;
        }
    });
}
