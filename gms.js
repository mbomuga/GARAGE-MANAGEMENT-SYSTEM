function admindelete()
{
	var label = document.admindelete.label.value;
	var direction = document.admindelete.direction.value;

	if (label == "" || direction == "")
	{
		alert("Missing Field(s)!");

		return false;
	}

	return ( true );
}

function admininsert()
{
	var label = document.admininsert.label.value;
	var type = document.admininsert.type.value;
	var duration = document.admininsert.duration.value;
	var direction = document.admininsert.direction.value;

	if (label == "" || direction == ""|| type == "" || duration == "")
	{
		alert("Missing Field(s)!");

		return false;
	}

	return ( true );
}

function adminupdate()
{
	var updatevalue = document.adminupdate.updatevalue.value;
	var label = document.adminupdate.label.value;
	var direction = document.adminupdate.direction.value;

	if(updatevalue == "" || label == "" || direction == "")
	{
		alert("Missing Field(s)!");

		return false;
	}

	return ( true );
}

function adminsearch()
{
	var key = document.adminsearch.key.value;

	if (key == "")
	{
		alert("Missing Field!");

		return false;
	}

	return ( true );
}

function deletenotifications()
{
	var direction = document.deletenotifications.direction.value;
	var report = document.deletenotifications.report.value;

	if(direction == "" || report == "")
	{
		alert("Missing Field(s)!");

		return false;
	}

	return ( true );
}

function inserthistory()
{
	var label = document.inserthistory.label.value;
	var period = document.inserthistory.period.value;
	var lapse = document.inserthistory.lapse.value;
	var report = document.inserthistory.report.value;
	var quota = document.inserthistory.quota.value;
	var direction = document.inserthistory.direction.value;

	if (label == "" || period == "" || lapse == "" || report == "" || quota == "" || direction == "")
	{
		alert("Missing Field(s)!");

		return false;
	}

	return ( true );
}

function insertnotifications()
{
	var signal = document.insertnotifications.alert.value;
	var nature = document.insertnotifications.nature.value;
	var relevance = document.insertnotifications.relevance.value;
	var direction = document.insertnotifications.direction.value;

	if (signal == "" || nature == "" || relevance == "" || direction == "")
	{
		alert("Missing Field(s)!");

		return false;
	}

	return ( true );
}

function insertschedule()
{
	var period = document.insertschedule.period.value;
	var lapse = document.insertschedule.lapse.value;

	if (period == "" || lapse == "")
	{
		alert("Missing Field(s)!");

		return false;
	}

	return ( true );
}

function login()
{
	var email = document.login.email.value;
	var key = document.login.key.value;

	if (email == "" || key == "")
	{
		alert("Missing Email Address or Password!");

		return false;
	}

	return ( true );
}

function payment()
{
	var scenario = document.payment.scenario.value;

	if (scenario == "")
	{
		alert("Missing Field");

		return false;
	}

	return ( true );
}

function register()
{
	var first = document.registration.first.value;
	var last = document.registration.last.value;
	var email = document.registration.email.value;
	var p1 = document.registration.password1.value;
	var p2 = document.registration.password2.value;
	var phone = document.registration.phone.value;

	if (first == "" || last == "" || email == "" || p1 == "" || p2 == "" || phone == "")
	{
		alert("Missing Field(s)!");

		return false;
	}

	if (p1 != p2)
	{
		alert("Password Mismatch!")
	}

	if (p1.length < 6 || p2.length < 6)
	{
		alert("Password should be at Least 6 characters");

		return false;
	}

	return ( true );
}

function updateschedule()
{
	var criterion = document.updateschedule.criterion.value;
	var direction = document.updateschedule.direction.value;

	if (criterion == "" || direction == "")
	{
		alert("Missing Field(s)!");

		return false;
	}

	return ( true );
}

function updatehistory()
{
	var updatetype = document.updatehistory.updatetype.value;
	var updatevalue = document.updatehistory.updatevalue.value;
	var remarks = document.updatehistory.remarks.value;
	var index = document.updatehistory.index.value;
	var direction = document.updatehistory.direction.value;

	if (index != "" || direction != "")
	{
		if (updatetype != "report")
		{
			if (updatevalue == "")
			{
				alert("Missing Field!");

				return false;
			}
		}
		else
		{
			if (remarks == "")
			{
				alert("Missing Field!");

				return false;
			}
		}
	}
	else
	{
		alert("Missing Field(s)!");

		return false;
	}

	return ( true );
}

function updatenotifications()
{
	var updatetype = document.updatenotifications.updatetype.value;
	var updatevalue = document.updatenotifications.updatevalue.value;
	var report = document.updatenotifications.report.value;

	if(report != "")
	{
		if (updatetype != "category" && updatetype != "priority")
		{
			if (updatevalue == "")
			{
				alert("Missing Field");

				return false;
			}
		}
	}
	else
	{
		alert("Missing Field!");

		return false;
	}

	return ( true );
}

function updatepassword()
{
	var regulate = document.updatepassword.regulate.value;
	var adjust = document.updatepassword.adjust.value;
	var examine = document.updatepassword.examine.value;

	if (regulate != "")
	{
		if (adjust != examine)
		{
			alert("Password Mismatch!");

			return false;
		}

		if (adjust.length < 6 || examine.length < 6)
		{
			alert("Password should be a minimum of 6 Characters");

			return false;
		}
	}
	else
	{
		alert("Please Enter your Current Password");

		return false;
	}

	return ( true );
}

function updateprofile()
{
	var updatevalue = document.updateprofile.updatevalue.value;

	if (updatevalue == "")
	{
		alert("Missing Field!");

		return false;
	}

	return ( true );
}

function userdelete()
{
	var label = document.userdelete.label.value;

	if (label == "")
	{
		alert("Missing Field!");

		return false;
	}

	return ( true );
}

function userinsert()
{
	var label = document.userinsert.label.value;
	var type = document.userinsert.type.value;
	var duration = document.userinsert.duration.value;

	if (label == "" || type == "" || duration == "")
	{
		alert("Missing Field(s)!");

		return false;
	}

	return ( true );
}

function userupdate()
{
	var updatevalue = document.userupdate.updatevalue.value;
	var label = document.userupdate.label.value;

	if (updatevalue == "" || label == "")
	{
		alert("Missing Field(s)!");

		return false;
	}

	return ( true );
}

function usersearch()
{
	var key = document.usersearch.key.value;

	if (key == "")
	{
		alert("Missing Field(s)!");

		return false;
	}

	return ( true );
}