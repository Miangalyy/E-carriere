<template>
    <button class="boutton ml-4" data-toggle="modal" data-target="#createNVModal">
        <i class="fa fa-plus"> Ajouter</i>
    </button>
    
 <!-- Modal -->
<div class="modal fade" id="createNVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background: #2a2185; color: #fff;">
          <h5 class="modal-title" id="exampleModalLabel">Nouveau formation</h5>
          <button type="button" class="close" @click="closeModal" style="color: #fff;">
            <span aria-hidden="true" style="color: #fff;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="soumettre" id="createForm">
             <div class="form-group">
                <label for="nom">Nom_Formation :</label>
                <input v-model="ne" name="nom" required type="text" class="form-control" 
                :class="{'is-invalid': neError != '' }"/>
                <span v-if="neError != '' " class="invalid-feedback error">{{ neError }}</span>
             </div>
             <div class="form-group">
                <label for="nom">Organisme_Formation :</label>
                <input v-model="orgf" name="nom" required type="text" class="form-control"/>
             </div>
             <div class="form-group">
                <label for="nom">Description :</label>
                <textarea v-model="desc" name="nom" class="form-control"
                :class="{'is-invalid': descriptionError != '' }"></textarea>
                <span v-if="descriptionError != '' " class="invalid-feedback error">{{ descriptionError }}</span>
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


const ne = ref("");
const orgf = ref("");
const desc = ref("");
const neError = ref("");
const descriptionError = ref("");
let createModal = ""
onMounted(() => {
  createModal =  $("#createNVModal")
})
const closeModal = ()=>{
    createModal.modal("hide")
    
  }
  const soumettre = ()=>{
    const nom_formation = ne.value
    const organisme_formation = orgf.value
    const description = desc.value
    const url = route("formation.create")
    Inertia.post(url, {nom_formation, organisme_formation, description}, {
      onSuccess: (page) => {
        closeModal()

        //Message de success
        useSwalSuccess("Experience ajouté avec success !")

      },
      onError: (Errors) => {
        if(Errors.nom_formation != null){
           neError.value = Errors.nom_formation
           console.log(neError)
          useSwalError("Une erreur s'est produite :(")
        }
        if(Errors.description != null){
          descriptionError.value = Errors.description
          useSwalError("Une erreur s'est produite :(")
        }
        

      }
    })

  }
</script>