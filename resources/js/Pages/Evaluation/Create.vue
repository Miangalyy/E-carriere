<template>
    <button class="boutton ml-4" data-toggle="modal" data-target="#createNVModal">
        <i class="fa fa-plus"> Ajouter</i>
    </button>
    
 <!-- Modal -->
<div class="modal fade" id="createNVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background: #2a2185; color: #fff;">
          <h5 class="modal-title" id="exampleModalLabel">Nouveau Evaluation</h5>
          <button type="button" class="close" @click="closeModal" style="color: #fff;">
            <span aria-hidden="true" style="color: #fff;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="soumettre" id="createForm">
             <div class="form-group">
                <label for="nom">Titre de l'evaluation :</label>
                <input v-model="title" name="nom" required type="text" class="form-control" 
                :class="{'is-invalid': titleError != '' }"/>
                <span v-if="titleError != '' " class="invalid-feedback error">{{ titleError }}</span>
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
import { useSwalSuccess, useSwalError } from "../../Composables/alert.js"


const title = ref("");
const titleError = ref("");
let createModal = ""
onMounted(() => {
  createModal =  $("#createNVModal")
})
const closeModal = ()=>{
    createModal.modal("hide")
    
  }
  const soumettre = ()=>{
    const titre = title.value
    const url = route("evaluation.create")
    Inertia.post(url, {titre}, {
      onSuccess: (page) => {
        closeModal()
        title.value = ""
        //Message de success
        useSwalSuccess("Evaluation ajouté avec success !")

      },
      onError: (Errors) => {
        if(Errors.titre != null){
           titleError.value = Errors.titre
           console.log(neError)
          useSwalError("Une erreur s'est produite :(")
        }
        

      }
    })

  }
</script>