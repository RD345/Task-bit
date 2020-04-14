function row_select(el)
{
    document.getElementById('task_num').value = el.children[0].innerHTML;
 
    if (el.children[4].value == 'on' || el.children[4].value == 1)
        document.getElementById('isdone').value = 'on';
}