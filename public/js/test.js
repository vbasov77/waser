var countOfFields = 1; // Текущее число полей
var curFieldNameId = 0; // Уникальное значение для атрибута name
var maxFieldLimit = 6; // Максимальное число возможных полей

// var al1 = array;
//

function deleteField(a) {
    // Получаем доступ к ДИВу, содержащему поле
    var contDiv = a.parentNode;
    // Удаляем этот ДИВ из DOM-дерева
    contDiv.parentNode.removeChild(contDiv);
    // Уменьшаем значение текущего числа полей
    countOfFields--;
    // Возвращаем false, чтобы не было перехода по сслыке
    return false;
}
function addField() {
    // Проверяем, не достигло ли число полей максимума
    if (countOfFields >= maxFieldLimit) {
        alert("Число полей достигло своего максимума");
        return false;
    }
    // Увеличиваем текущее значение числа полей
    countOfFields++;
    // Увеличиваем ID
    curFieldNameId++;
    // Создаем элемент ДИВ
    var div = document.createElement("div");
    // Добавляем HTML-контент с пом. свойства innerHTML
    div.innerHTML = "<input class=\"form-control\" name=\"name_cost[" + curFieldNameId + "]\" type=\"text\" /><br> <input class=\"form-control\" name=\"cost[" + curFieldNameId + "]\" type=\"text\" /> <a onclick=\"return deleteField(this)\" href=\"#\">[X]</a><br>";
    // Добавляем новый узел в конец списка полей
    document.getElementById("parentId").appendChild(div);
    // Возвращаем false, чтобы не было перехода по сслыке
    return false;
}
