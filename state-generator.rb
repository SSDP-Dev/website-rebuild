# Quick ruby script to generate some MD files for us
# TODO: Delete from repo 
def state_names
  %w(Alaska Alabama Arizona California Colorado Connecticut District-of-Columbia Delaware Florida Georgia Guam Hawaii Idaho Illinois Indiana Kansas Kentucky Louisiana Massachusetts Maryland Maine Michigan Mississippi Montana North-Carolina New-Hampshire New-Jersey New-Mexico Nevada New-York Ohio Oklahoma Oregon Pennsylvania Rhode-Island South-Carolina Tennessee Texas Utah Virginia Vermont Washington Wisconsin West-Virginia Wyoming)
end

state_names.each do |state|
  puts state
  data = \
"""
+++
state_name=" + '"' + state.to_s + '"' + "
+++
"""
  File.open("./states/" + state.to_s + ".md", "w+") { |file| file.write(data) }
end
