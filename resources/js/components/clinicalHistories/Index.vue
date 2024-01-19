<!-- ClinicalHistoryList.vue -->

<template>
  <div>
    <ul class="list-group list-group-flush container">
      <li class="mb-4 list-group-item d-flex justify-content-between align-items-start" v-for="history in clinicalHistories" :key="history.id">
        <div class="ms-2 me-auto row">
          <div class="col-md-6 col-sm-12">
            <div class="fw-bold">Patient</div>
            {{ `${history.patient.name} ${history.patient.surnames}` }} 
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="fw-bold">Professional</div>
            {{ `${history.professional.name} ${history.professional.surnames}` }} 
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="fw-bold">Relevant information</div>
            {{ history.relevant_information }} 
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="fw-bold">Current status</div>
            {{ history.current_status }} 
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="fw-bold">Background Information</div>
            {{ history.background_information }} 
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="fw-bold">Assisted</div>
            {{ history.assisted ? 'Yes' : 'No' }} 
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="fw-bold">Signatures</div>
            {{ history.signatures }} 
          </div>
        </div>
        <a class="badge bg-primary rounded-pill col-3" :href="'/clinicalhistories/' + history.id + '/edit'">Editar</a>
      </li>
    </ul>
  </div>
</template>

<script>
import Swal from 'sweetalert2';

export default {
  props: {
    userId: {
      type: Number,
      required: true,
    },
    roles: {
      type: Array,
      required: true,
    },
    clinicalHistories: {
      type: Array,
      required: true,
    },
  },
  created() {
    window.Echo.channel("notification-channel")
      .listen("NotificationSent", (event) => {
        console.log('Evento recibido:', event);
        if(
          this.userId == event.notification.patient_id || 
          this.userId == event.notification.professional_id
        ) {
          const hasProfessionalRole = this.roles.some(role => role.name === 'professional');

          if (hasProfessionalRole) {
            Swal.fire({
              icon: 'success',
              title: 'Review this medical history related to your user',
              html: `Click <a href='/clinicalhistories/${event.notification.id}/edit'>here</a>`,
              showConfirmButton: false,
              timer: 5000,
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Review this medical history related to your user',
              showConfirmButton: false,
              timer: 5000, 
            });
          }
        }
        window.location.href = '/clinicalhistories';
      });
  },
};
</script>

<style scoped>
/* styles here */
</style>
