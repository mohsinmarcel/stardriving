$(document).on('change','.learner-strengths',function(){
    let key = $(this).data('value')
    let learnerCheckBox = $('input.learner-weaknesses[data-value="'+key+'"]')
    if($(this).prop("checked") == true){
        $(learnerCheckBox).prop('disabled',true)
    }
    else if($(this).prop("checked") == false){
        $(learnerCheckBox).prop('disabled',false)
    }
})
$(document).on('change','.instructor-strengths',function(){
    let key = $(this).data('value')
    let instructorCheckBox = $('input.instructor-weaknesses[data-value="'+key+'"]')
    if($(this).prop("checked") == true){
        $(instructorCheckBox).prop('disabled',true)
    }
    else if($(this).prop("checked") == false){
        $(instructorCheckBox).prop('disabled',false)
    }
})
$(document).on('change','.learner-weaknesses',function(){
    let key = $(this).data('value')
    let learnerCheckBox = $('input.learner-strengths[data-value="'+key+'"]')
    if($(this).prop("checked") == true){
        $(learnerCheckBox).prop('disabled',true)
    }
    else if($(this).prop("checked") == false){
        $(learnerCheckBox).prop('disabled',false)
    }
})
$(document).on('change','.instructor-weaknesses',function(){
    let key = $(this).data('value')
    let instructorCheckBox = $('input.instructor-strengths[data-value="'+key+'"]')
    if($(this).prop("checked") == true){
        $(instructorCheckBox).prop('disabled',true)
    }
    else if($(this).prop("checked") == false){
        $(instructorCheckBox).prop('disabled',false)
    }
})