function SObject = {

	id: null,
	name: null,
	value: null,
	position: null,

	set: function(property, value){

		this[property] = value;
	}

	get: function(property){

		return this[property];
	}
}