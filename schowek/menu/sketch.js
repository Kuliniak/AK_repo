var count = 1;

function tworz() {
	count++;
	//var formularz = document.getElementById("zadania");
	var div = document.getElementById("d_zadania");
	var input_zad = document.createElement("textarea");
	var input_data_start = document.createElement("input");
	var input_data_koniec = document.createElement("input");
	//var fields = document.getElementsByName("zadanie[]");

	input_zad.value = count + ". ";
	input_zad.name = "zadanie[]";
	input_zad.id = "z" + count;

	input_data_start.name = "s_data[]";
	input_data_start.placeholder = "Początek zadania";

	input_data_koniec.name = "f_data[]";
	input_data_koniec.placeholder = "Koniec zadania";

	div.appendChild(input_zad);

	//console.log(fields[length]);

	//div.appendChild(input_data_start);
	//div.appendChild(input_data_koniec);
}

function niszcz() {
	var fields = document.getElementsByName("zadanie[]");
	var element_id = "z" + count;
	//var element_data_start = "s_data" + count;
	//var element_data_koniec = "f_data" + count;

	if(count > 0) {
		//$('input[name='+element_data_start+']').remove();
		//$('input[name='+element_data_koniec+']').remove();
		$('textarea[id='+element_id+']').remove();
		count--;
	}
}
