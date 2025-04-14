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
  const [serverError, setServerError] = useState(null);

  const fieldLabels = {
    name: "Name:",
    number: "Phone Number:",
    email: "Email:",
    password1: "Password:",
    password2: "Confirm Password:"
  };

  const validate = (updatedForm) => {
    const newErrors = {};
    let isValid = true;
  
    if (!/^[A-Za-z\s]+$/.test(updatedForm.name)) {
      newErrors.name = "Only letters allowed";
      isValid = false;
    }
    if (!/^\d{7,15}$/.test(updatedForm.number)) {
      newErrors.number = "Enter a valid phone number";
      isValid = false;
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(updatedForm.email)) {
      newErrors.email = "Invalid email";
      isValid = false;
    }
    if (updatedForm.password1.length < 6) {
      newErrors.password1 = "At least 6 characters";
      isValid = false;
    }
    if (updatedForm.password2 !== updatedForm.password1) {
      newErrors.password2 = "Passwords do not match";
      isValid = false;
    }
  
    setErrors(newErrors);
    return isValid;
  };

  const handleChange = (e) => {
    const { name, value } = e.target;
    setForm(prevForm => {
      const updatedForm = { ...prevForm, [name]: value };
      validate(updatedForm);
      return updatedForm;
    });
  };
  
  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!validate(form)) return;

    const formData = new FormData();
    Object.entries(form).forEach(([key, value]) => {
      formData.append(key, value);
    });

    try {
      const response = await fetch("../backend/auth_signup.php", {
        method: "POST",
        body: formData,
        credentials: "include"
      });

      const result = await response.json();
      if (result.success) {
        alert("You have successfully created your account!");
        window.location.href = result.redirect;
      } else {
        setServerError(result.message || "Signup failed.");
      }
    } catch (error) {
      console.error("Error:", error);
      alert("Something went wrong. Please try again.");
    }
  };

  return (
    <form onSubmit={handleSubmit}>
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

      {serverError && <p className="error-message">{serverError}</p>} {}

      <div>
          <h3>Already have an account? <a href="./login.php">Log in here</a></h3>
      </div>

      <input type="submit" className="form-submit" value="Sign Up" />
    </form>
  );
}

ReactDOM.createRoot(document.getElementById('signup-root')).render(<SignupForm />);
 