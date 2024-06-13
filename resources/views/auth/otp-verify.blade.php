<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>4-Digit OTP Form</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

  <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
    <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Enter OTP</h2>
    <form class="flex justify-between space-x-4">
      <input type="text" maxlength="1" class="otp-input w-16 h-16 text-2xl text-center border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" autofocus>
      <input type="text" maxlength="1" class="otp-input w-16 h-16 text-2xl text-center border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
      <input type="text" maxlength="1" class="otp-input w-16 h-16 text-2xl text-center border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
      <input type="text" maxlength="1" class="otp-input w-16 h-16 text-2xl text-center border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
    </form>
    <button class="mt-6 w-full bg-blue-500 text-white py-3 rounded-lg text-lg font-semibold hover:bg-blue-600 transition duration-300">Verify</button>
  </div>

  <script>
    // Automatically focus next input field
    const inputs = document.querySelectorAll('.otp-input');
    inputs.forEach((input, index) => {
      input.addEventListener('input', () => {
        if (input.value.length === 1) {
          if (index < inputs.length - 1) {
            inputs[index + 1].focus();
          }
        }
      });
    });
  </script>

</body>
</html>
