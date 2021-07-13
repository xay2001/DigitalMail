/**
 * 校验
 */
function validate_required(field,alerttxt)
{
with (field)
  {
  if (value==null||value=="")
    {alert(alerttxt);return false}
  else {return true}
  }
}

function validate_equal(field1,field2, alerttxt)
{
	var value1, value2;
	with (field1)
	{
		value1 = value;
	}
	with (field2)
	{
		value2 = value;
	}
	if(value1 != value2){
		alert(alerttxt);
		return false;
	}else{
		return true;
	}
}