function limit(nume,name,limit){
    console.log(nume);
    var contle = nume.toString().length;
    console.log(contle);
    if (contle >= limit){
        $("#"+name).val(nume.toString().substring(0,limit-1));
    }
}