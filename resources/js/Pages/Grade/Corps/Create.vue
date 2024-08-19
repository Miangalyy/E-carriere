<template>
    <button class="boutton ml-4" data-toggle="modal" data-target="#createNVModal">
        <i class="fa fa-plus"> Ajouter</i>
    </button>
    
 <!-- Modal -->
<div class="modal fade" id="createNVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background: #2a2185; color: #fff;">
          <h5 class="modal-title" id="exampleModalLabel">Nouveau corps</h5>
          <button type="button" class="close" @click="closeModal">
            <span aria-hidden="true" style="color: #fff;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="soumettre" id="createForm">
             <div class="form-group">
                <label for="nom">Numero_Corps :</label>
                <input v-model="nd" name="numero_direction" required type="text" class="form-control" 
                :class="{'is-invalid': ndError != '' }"/>
                <span v-if="ndError != '' " class="invalid-feedback error">{{ ndError }}</span>
             </div>
             <div class="form-group">
                <label for="nom">Titre :</label>
                <input v-model="titre" name="titre" required type="text" class="form-control"/>
             </div>
             <div class="form-group">
                <label for="nom">Description :</label>
                <textarea v-model="desc" name="description" class="form-control"
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


const nd = ref("");
const titre = ref("");
const desc = ref("");
const ndError = ref("");
const descriptionError = ref("");
let createModal = ""
onMounted(() => {
  createModal =  $("#createNVModal")
})
const closeModal = ()=>{
    createModal.modal("hide")
    
  }
  const soumettre = ()=>{
    const numero_corps = nd.value
    const title = titre.value
    const description = desc.value
    const url = route("corps.create")
    Inertia.post(url, {numero_corps, title, description}, {
      onSuccess: (page) => {
        closeModal()

        //Message de success
        useSwalSuccess("Corps ajouté avec success !")

      },
      onError: (Errors) => {
        if(Errors.numero_corps != null){
           ndError.value = Errors.numero_corps
           console.log(ndError)
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