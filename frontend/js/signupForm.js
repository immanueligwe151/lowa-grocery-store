const { useState } = React;

function SignupForm() {
  const [form, setForm] = useState({
    name: '',
    number: '',
    email: '',
    password1: '',
    password2: ''
  });

  const [errors, setErrors] = useState({});

  const fieldLabels = {
    name: "Name:",
    number: "Phone Number:",
    email: "Email:",
    password1: "Password",
    password2: "Confirm Password"
  };

  const validate = () => {
    const newErrors = {};
    let isValid = true;

    if (!/^[A-Za-z\s]+$/.test(form.name)) {
      newErrors.name = "Only letters allowed";
      isValid = false;
    }
    if (!/^\d{7,15}$/.test(form.number)) {
      newErrors.number = "Enter a valid phone number";
      isValid = false;
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email)) {
      newErrors.email = "Invalid email";
      isValid = false;
    }
    if (form.password1.length < 6) {
      newErrors.password1 = "At least 6 characters";
      isValid = false;
    }
    if (form.password2 !== form.password1) {
      newErrors.password2 = "Passwords do not match";
      isValid = false;
    }

    setErrors(newErrors);
    return isValid;
  };

  const handleChange = (e) => {
    const { name, value } = e.target;
    setForm({ ...form, [name]: value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!validate()) return;

    const formData = new FormData();
    Object.entries(form).forEach(([key, value]) => {
      formData.append(key, value);
    });

    try {
      const response = await fetch(".../backend/auth_signup.php", {
        method: "POST",
        body: formData
      });

      const result = await response.json();
      if (result.success) {
        alert("You have successfully created your account!");
        // to sign user in and redirect them to home page
      } else {
        alert(result.message || "Signup failed.");
      }
    } catch (error) {
      console.error("Error:", error);
      alert("Something went wrong. Please try again.");
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      {Object.entries(fieldLabels).map(([field, label]) => (
        <div className="form-fields" key={field}>
          <label htmlFor={field}>{label}</label>
          <input
            type={field.includes("password") ? "password" : field === "email" ? "email" : "text"}
            id={field}
            name={field}
            value={form[field]}
            onChange={handleChange}
            required
          />
          {errors[field] && <p className="error-message">{errors[field]}</p>}
        </div>
      ))}

      <input type="submit" value="Sign Up" />
    </form>
  );
}

ReactDOM.createRoot(document.getElementById('signup-root')).render(<SignupForm />);


/* const { useState } = React;

function SignupForm() {
  const [form, setForm] = useState({
    name: '',
    number: '',
    email: '',
    password1: '',
    password2: ''
  });

  const [errors, setErrors] = useState({});

  const fieldLabels = {
    name: "Name:",
    number: "Phone Number:",
    email: "Email:",
    password1: "Password",
    password2: "Confirm Password"
  };

  const validate = () => {
    const newErrors = {};
    let isValid = true;
  
    if (!/^[A-Za-z\s]+$/.test(form.name)) {
      newErrors.name = "Only letters allowed";
      isValid = false;
    }
    if (!/^\d{7,15}$/.test(form.number)) {
      newErrors.number = "Enter a valid phone number";
      isValid = false;
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email)) {
      newErrors.email = "Invalid email";
      isValid = false;
    }
    if (form.password1.length < 6) {
      newErrors.password1 = "At least 6 characters";
      isValid = false;
    }
    if (form.password2 !== form.password1) {
      newErrors.password2 = "Passwords do not match";
      isValid = false;
    }
  
    setErrors(newErrors);
    return isValid;
  };

  const handleChange = (e) => {
    const { name, value } = e.target;
    setForm({ ...form, [name]: value });
    validate(name, value);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!validate()) return;

    const formData = new FormData();
    Object.entries(form).forEach(([key, value]) => {
      formData.append(key, value);
    });

    try {
      const response = await fetch("/backend/auth_signup.php", {
        method: "POST",
        body: formData
      });

      const result = await response.json();
      if (result.success) {
        alert("You have succesfully created your account!");
        // to sign user in and redirect them to home page
      } else {
        alert(result.message || "Signup failed.");
      }
    } catch (error) {
      console.error("Error:", error);
      alert("Something went wrong. Please try again.");
    }
  };

  return (
    <form>
      { }
      {Object.entries(fieldLabels).map(([field, label]) => (
        <div className="form-fields" key={field}>
          <label htmlFor={field}>{label}</label>
          <input
            type={field.includes("password") ? "password" : field === "email" ? "email" : "text"}
            id={field}
            name={field}
            value={form[field]}
            onChange={handleChange}
            required
          />
          {errors[field] && <p className="error-message">{errors[field]}</p>}
        </div>
      ))}

      <input type="submit" value="Sign Up" />
    </form>
  );
}

ReactDOM.createRoot(document.getElementById('signup-root')).render(<SignupForm />);
 */