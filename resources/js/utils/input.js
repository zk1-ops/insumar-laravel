export const rules = {
  startsWithSteam: v => /^STEAM_0/.test(v) || 'Este campo debe empezar con STEAM_0',
  required: v => !!v || 'Este campo es requerido',
  email: v => /.+@.+\..+/.test(v) || 'El mail ingresado no es valido',
  minLength: x => v => v.length >= x || `Este campo requiere como mínimo ${x} carácteres`,
  maxLength: x => v => v.length <= x || `Este campo excede el máximo de ${x} carácteres`,
  password: x => v => v === x || 'La contraseña de confirmación debe coincidir con la escrita en el campo anterior',
  isString: v => !/\d/.test(v) || 'Este campo no admite números',
  notBlank: v => !!v.trim() || 'Este campo no puede estar en blanco'  
}
