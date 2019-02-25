function onlyNumbers(obj) {
    obj.value = obj.value.replace(/[^\d.-]/g,'');
}