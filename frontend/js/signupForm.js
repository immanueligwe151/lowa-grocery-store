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

  const validate = (name, value) => {
    const newErrors = { ...errors };
    
    switch (name) {
      case 'name':
        newErrors.name = /^[A-Za-z\s]+$/.test(value) ? '' : 'Only letters allowed';
        break;
      case 'number':
        newErrors.number = /^\d{7,15}$/.test(value) ? '' : 'Enter a valid phone number';
        break;
      case 'email':
        newErrors.email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value) ? '' : 'Invalid email';
        break;
      case 'password1':
        newErrors.password1 = value.length >= 6 ? '' : 'At least 6 characters';
        break;
      case 'password2':
        newErrors.password2 = value === form.password1 ? '' : 'Passwords do not match';
        break;
    }

    setErrors(newErrors);
  };

  const handleChange = (e) => {
    const { name, value } = e.target;
    setForm({ ...form, [name]: value });
    validate(name, value);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    alert("Form submitted successfully!");
    // Post data to PHP backend here
  };

  return (
    <form>
      {}
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
