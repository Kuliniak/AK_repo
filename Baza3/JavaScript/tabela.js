//Skrypt tworzenia nowych wierszy w tabeli z zadaniami(create_proj.php)
var row_id = 0;

function dodaj() {
	row_id++;
	var tabela = document.getElementById("tablica");
	var input_sprint = document.createElement("input");
	var input_data_start = document.createElement("input");
	var input_data_koniec = document.createElement("input");
	var input_del = document.createElement("input");

	input_sprint.setAttribute("type", "text");
	input_sprint.setAttribute("name", "sprint[]");
	input_sprint.setAttribute("placeholder", "Sprint");

	input_data_start.setAttribute("type", "date");
	input_data_start.setAttribute("name", "od[]");
	input_data_start.setAttribute("placeholder", "Od (dd-mm-yyyy)");

	input_data_koniec.setAttribute("type", "date");
	input_data_koniec.setAttribute("name", "do[]");
	input_data_koniec.setAttribute("placeholder", "Do (dd-mm-yyyy)");

	input_del.setAttribute("type", "button");
	input_del.setAttribute("onclick", "usun(this);");
	input_del.setAttribute("value", "-");
	

	var row = tabela.insertRow(-1);
	row.setAttribute("id", "row"+row_id);

	var cell0 = row.insertCell(0);
	var cell1 = row.insertCell(1);
	var cell2 = row.insertCell(2);
	var cell3 = row.insertCell(3);

	cell0.appendChild(input_sprint);
	cell1.appendChild(input_data_start);
	cell2.appendChild(input_data_koniec);
	cell3.appendChild(input_del);
}

function usun(index)
{
	var p = index.parentNode.parentNode;
	p.parentNode.removeChild(p);
}
