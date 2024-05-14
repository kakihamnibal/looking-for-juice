
        
function discovery(postId) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: `/discover/${postId}`,
        type: "POST",
    })
    .done(function (data, status, xhr) {
        window.location.href = `/posts/${postId}`;
    })
    .fail(function (xhr, status, error) {
        alert('この機能はログインユーザー限定です');
    });
}

function cancelDiscover(postId) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: `/notDiscover/${postId}`,
        type: "POST",
    })
    .done(function (data, status, xhr) {
        window.location.href = `/posts/${postId}`;
    })
    .fail(function (xhr, status, error) {
        alert('この機能はログインユーザー限定です');
    });
}
