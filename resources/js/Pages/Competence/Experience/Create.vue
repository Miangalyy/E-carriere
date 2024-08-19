<template>
    <button class="boutton ml-4" data-toggle="modal" data-target="#createNVModal">
        <i class="fa fa-plus"> Ajouter</i>
    </button>
    
 <!-- Modal -->
<div class="modal fade" id="createNVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background: #2a2185; color: #fff;">
          <h5 class="modal-title" id="exampleModalLabel">Nouveau Experience</h5>
          <button type="button" class="close" @click="closeModal" style="color: #fff;">
            <span aria-hidden="true" style="color: #fff;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="soumettre" id="createForm">
             <div class="form-group">
                <label for="nom">Fonction :</label>
                <input v-model="fonc" name="nom" required type="text" class="form-control"  :class="{'is-invalid': foncError != '' }"/>
                <span v-if="foncError != '' " class="invalid-feedback error">{{ foncError }}</span>
             </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" @click="closeModal">Fermer</button>
          <button form="createForm" type="submit" class="btn btn-success">Soumettre</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
 import { ref, onMounted } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useSwalSuccess, useSwalError } from "../../../Composables/alert.js"


const fonc = ref("");
const foncError = ref("");
let createModal = ""
onMounted(() => {
  createModal =  $("#createNVModal")
})
const closeModal = ()=>{
   fonc.value = "";
   foncError.value = "";
    createModal.modal("hide")
    
  }
  const soumettre = ()=>{
    const fonction = fonc.value
    const url = route("experience.create")
    Inertia.post(url, {fonction}, {
      onSuccess: (page) => {
        closeModal()

        //Message de success
        useSwalSuccess("Experience ajouté avec success !")

      },
      onError: (Errors) => {
        if(Errors.fonction != null){
          foncError.value = Errors.fonction
          useSwalError("Une erreur s'est produite :(")
        }
        

      }
    })

  }
</script>