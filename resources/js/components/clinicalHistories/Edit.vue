<template v-if="!loading">
  <div>
    <h2>Edit Clinical History</h2>
    <form @submit.prevent="updateClinicalHistory">
      <div class="mb-3">
        <label for="patient_id" class="form-label">Patient:</label>
        <select v-model="clinicalHistory.patient_id" class="form-select" required :disabled="!isProfessional">
          <option value="" disabled>Select Patient</option>
          <option v-for="patient in patients" :key="patient.id" :value="patient.id">{{ `${patient.name} ${patient.surnames}` }}</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label" for="relevant_information">Relevant Information:</label>
        <textarea class="form-control" v-model="clinicalHistory.relevant_information" :disabled="!isProfessional"></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label" for="current_status">Current Status:</label>
        <input class="form-control" v-model="clinicalHistory.current_status" type="text" :disabled="!isProfessional">
      </div>
      <div class="mb-3">
        <label class="form-label" for="background_information">Background Information:</label>
        <textarea class="form-control" v-model="clinicalHistory.background_information" :disabled="!isProfessional"></textarea>
      </div>
      <div class="mb-3">
        <label class="form-check-label" for="assisted">Assisted:</label>
        <input class="form-check-input" type="checkbox" v-model="clinicalHistory.assisted" :checked="clinicalHistory.assisted">
      </div>
      <div class="mb-3">
        <label class="form-label" for="signatures">Signatures:</label>
        <textarea class="form-control" v-model="clinicalHistory.signatures"></textarea>
      </div>
      <button class="btn btn-primary mb-3" type="submit">Update Clinical History</button>
    </form>
    <button class="btn btn-danger" @click="deleteClinicalHistory">Delete Clinical History</button>
  </div>
</template>
  
<script>
  export default {
    props: {
      roles: {
        type: Array,
        required: true,
      },
  },
    data() {
      return {
        clinicalHistory: {
          professional_id: null,
          patient_id: null,
          relevant_information: '',
          current_status: '',
          background_information: '', 
          assisted: false, 
          signatures: '', 
        },
        patients: [],
        isProfessional: false,
        loading: true,
      };
    },
    methods: {
      async fetchPatients() {
        try {
          const response = await axios.get('/users/patients');
          this.patients = response.data.usersWithPatientRole;
        } catch (error) {
          console.error('Error fetching patients:', error);
        }
      },
      async getDatum() {
        try {
          const response = await axios.get(`/clinicalhistories/${this.$route.params.id}`);
          this.clinicalHistory = response.data;
        } catch (error) {
          this.error = 'Error fetching clinical history details';
          console.error('Error fetching clinical history details:', error);
        }
      },
      updateClinicalHistory() {
        axios.put(`/clinicalhistories/${this.$route.params.id}`, this.clinicalHistory)
          .then(response => {
            window.location.href = '/clinicalhistories';
          })
          .catch(error => {
            console.error('Error updating clinical history:', error);
          });
      },
      async deleteClinicalHistory() {
        if (confirm('Are you sure you want to delete this clinical history?')) {
          try {
            await axios.delete(`/clinicalhistories/${this.$route.params.id}`);
            window.location.href = '/clinicalhistories';
          } catch (error) {
            console.error('Error deleting clinical history:', error);
          }
        }
      },
    },
    watch: {
      loading(newLoadingState) {
        if (!newLoadingState) {
          this.getDatum();
        }
      },
    },
    async mounted() {
      await this.fetchPatients();
      this.loading = false;
      if (this.roles && Array.isArray(this.roles)) {
      this.isProfessional = this.roles.some(role => role.name === 'professional');
    }
          console.log(this.roles)
    },
  };
</script>
  