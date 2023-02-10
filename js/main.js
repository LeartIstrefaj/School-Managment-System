const redirectTo = (url) => {
    windows.location.href = url
}

const show_modal = (element,regex = null) => {
    if(element !== null){
        const modal = new bootstrap.Modal(element, {
            keyboard: false
        })

        if(regex !== null){
            if(regex.test(location.href))
                modal.show()
        }else{
            modal.show()
        }
    }
    
}

show_modal(document.querySelector('#editModal'), /[?]action=edit/);




// document.querySelector('#show-modal-btn').addEventListener('click',e =>{
//     e.preventDefault()
//     show_modal(document.querySelector('#editModal'))
// });



