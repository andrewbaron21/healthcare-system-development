<template>
    <div>
      <div class="container">
        <div class="row">
            <form @submit.prevent="saveClinicalHistory">
              <div class="mb-3">
                <label for="patient_id" class="form-label">Patient:</label>
                <select v-model="clinicalHistory.patient_id" class="form-select" required>
                  <option value="" disabled>Select Patient</option>
                  <option v-for="patient in patients" :key="patient.id" :value="patient.id">{{ `${patient.name} ${patient.surnames}` }}</option>
                </select>
              </div>
              <div class="mb-3">
                  <label for="relevant_information" class="form-label">Relevant Information:</label>
                  <textarea v-model="clinicalHistory.relevant_information" class="form-control"></textarea>
              </div>
              <div class="mb-3">
                  <label for="current_status" class="form-label">Current Status:</label>
                  <input v-model="clinicalHistory.current_status" type="text" class="form-control">
              </div>
              <div class="mb-3">
                <label for="background_information" class="form-label">Background Information:</label>
                <textarea v-model="clinicalHistory.background_information" class="form-control"></textarea>
              </div>
              <div class="mb-3">
                <label for="assisted" class="form-check-label">Assisted:</label>
                <input v-model="clinicalHistory.assisted" type="checkbox" class="form-check-input">
              </div>
              <div class="mb-3">
                <label for="signatures" class="form-label">Signatures:</label>
                <textarea v-model="clinicalHistory.signatures" class="form-control"></textarea>
              </div>
              
              <button type="submit" class="btn btn-primary">Save Clinical History</button>
            </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        clinicalHistory: {
          patient_id: null,
          relevant_information: '',
          current_status: '',
          background_information: '', 
          assisted: false, 
          signatures: '', 
        },
        patients: [],
      };
    },
    mounted() {
      // Fetch patients data when the component is mounted
      this.fetchPatients();
    },
    methods: {
      fetchPatients() {
      // Use axios or your preferred HTTP library to fetch data from the specified route
      axios.get('/users/patients')
        .then(response => {
          // Assuming the response.data directly contains an array of patients
          this.patients = response.data.usersWithPatientRole;
        })
        .catch(error => {
          console.error('Error fetching patients:', error);
        });
      },
      saveClinicalHistory() {
        // Send an API request to save the clinical history
        // Use axios or your preferred HTTP library
        axios.post('/clinicalhistories', this.clinicalHistory)
          .then(response => {
            // Handle success, e.g., redirect to the index page
            window.location.href = '/clinicalhistories';
          })
          .catch(error => {
            // Handle error, show a message, etc.
            console.error('Error saving clinical history:', error);
          });
      },
    },
  };
  </script>
  